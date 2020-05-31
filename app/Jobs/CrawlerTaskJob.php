<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerItem;
use App\Models\CrawlerShop;
use App\Models\CrawlerTask;
use App\Repositories\Member\MemberCoreRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function config;
use function current;
use function dd;
use function dispatch;
use function explode;
use function json_decode;
use function request;

class CrawlerTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    private $shopeeHandler;
    private $crawlerTask;

    public function __construct()
    {
        $this->shopeeHandler = new ShopeeHandler();
    }

    public function handle()
    {

        $crawlerTask = $this->crawlerTask();
        if($crawlerTask) {
            //先不給爬蟲
            $crawlerTask->is_crawler=0;
            $crawlerTask->save();
            $crawlerTask = $this->handle_page($crawlerTask);

            //組合Url連結組合
            $urls = $this->shopeeHandler->crawlerTaskGenerateAPIUrl($crawlerTask);

            //更新所 - Url
            foreach ($urls as $url) {
                $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
                $json = json_decode($ClientResponse->getBody(), true);

                //$member_id = Auth::guard('member')->check() ? Auth::guard('member')->user()->id : '1';
                $member_id = $crawlerTask->member_id;
                foreach ($json['items'] as $item) {

                    //商品資訊
                    $row_items[] = [
                        'itemid' => $item['itemid'],
                        'shopid' => $item['shopid'],
                        'sold' => $item['sold'] !== null ? $item['sold'] : 0,
                        'historical_sold' => $item['historical_sold'],
                        'domain_name' => $crawlerTask->domain_name,
                        'locale' => $crawlerTask->locale,
                        'member_id' => $member_id,
                        'updated_at' => null
                    ];

                    //商店資訊
                    $row_shops[] = [
                        'shopid' => $item['shopid'],
                        'shop_location' => "",
                        'locale' => $crawlerTask->locale,
                        'domain_name' => $crawlerTask->domain_name,
                        'member_id' => $member_id
                    ];

                    $value_arr[] = [$item['itemid'], $item['shopid'], $crawlerTask->locale];
                    $items_order[]=$item['itemid'];
                };

                if(isset($row_items)){
                    //批量儲存Item
                    $crawlerItem = new CrawlerItem();
                    $TF = (new MemberCoreRepository())->massUpdate($crawlerItem, $row_items);

                    //這次抓到的商品id 還有順序
                    $crawlerItem_ids = CrawlerItem::whereInMultiple(['itemid', 'shopid', 'locale'], $value_arr)
                        ->pluck('ci_id', 'itemid');

                    $insert_item_qty = config('crawler.insert_item_qty');
                    $index=$crawlerTask->current_page*$insert_item_qty + 1;
                    foreach ($items_order as $itemid){
                        $sync_ids[$crawlerItem_ids[$itemid]]= ['sort_order'=>$index++];
                    }

                    //Sync刪除並更新
                    if($crawlerTask->current_page == 0) {
                        $crawlerTask->crawlerItems()->detach();
                        $crawlerTask->crawlerItems()->sync($sync_ids);
                    }else{
                        $crawlerTask->crawlerItems()->syncwithoutdetaching($sync_ids);
                    }

                    //批量儲存Shop
                    $crawlerShop = new CrawlerShop();
                    $TF = (new MemberCoreRepository())->massUpdate($crawlerShop, $row_shops);
                }

            }

            $crawlerTask->current_page++;
            if($crawlerTask->current_page == $crawlerTask->pages){
                $crawlerTask->updated_at = Carbon::now();
            }
            $crawlerTask->is_crawler = 1;
            $crawlerTask->save();

            dispatch((new CrawlerTaskJob())->onQueue('instant'));
        }
    }

    public function handle_page($crawlerTask)
    {
        //當兩者相同，表示需要重新開始
        if($crawlerTask->current_page == $crawlerTask->pages){
            $crawlerTask->current_page=0;
        }
        return $crawlerTask;
    }

    /*
     * 更新Task
     * 條件 今天未更新 或 從為更新過 updated_at == null
    */
    public function crawlerTask()
    {

        $query = CrawlerTask::where(function ($query) {
            $query->whereDate('updated_at','<>',Carbon::today())
                ->orWhereNull('updated_at');

        })->orWhereRaw('current_page < pages')
            ->where('is_crawler', 1)
            ->where('is_active', 1)
            ->orderBy('member_id', 'DESC');

        $query = $this->shopeeHandler->crawlerSeperator($query);
        $crawlerTask = $query->first();
        return $crawlerTask;
    }
}

