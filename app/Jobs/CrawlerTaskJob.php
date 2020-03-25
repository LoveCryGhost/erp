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

    //處理的工作
    public function handle()
    {
        $crawlerTask = CrawlerTask::where(function ($query) {
            $query->whereDate('updated_at','<>',Carbon::today())->orWhereNull('updated_at');
        })->first();

        if($crawlerTask) {
            $urls = $this->shopeeHandler->crawlerTaskGenerateAPIUrl($crawlerTask);
            foreach ($urls as $url) {
                $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
                $json = json_decode($ClientResponse->getBody(), true);

                $member_id = Auth::guard('member')->check() ? Auth::guard('member')->user()->id : '1';
                foreach ($json['items'] as $item) {
                    $row_items[] = [
                        'itemid' => $item['itemid'],
                        'shopid' => $item['shopid'],
                        'sold' => $item['sold'] !== null ? $item['sold'] : 0,
                        'historical_sold' => $item['historical_sold'],
                        'domain_name' => $crawlerTask->domain_name,
                        'local' => $crawlerTask->local,
                        'member_id' => $member_id,
                        'updated_at' => null
                    ];

                    $row_shops[] = [
                        'shopid' => $item['shopid'],
                        'shop_location' => "",
                        'local' => $crawlerTask->local,
                        'domain_name' => $crawlerTask->domain_name,
                        'member_id' => $member_id
                    ];
                    $value_arr[] = [$item['itemid'], $item['shopid'], $crawlerTask->local];
                    $items_order[]=$item['itemid'];
                };

                //批量儲存Item
                $crawlerItem = new CrawlerItem();
                $TF = (new MemberCoreRepository())->massUpdate($crawlerItem, $row_items);

                //CrawlerTasks sync Items
                $crawlerItem_ids = CrawlerItem::whereInMultiple(['itemid', 'shopid', 'local'], $value_arr)
                    ->pluck('ci_id', 'itemid');
                $index=0;
                foreach ($items_order as $itemid){
                    $sync_ids[$crawlerItem_ids[$itemid]]= ['sort_order'=>$index++];
                }
                $crawlerTask->crawlerItems()->syncwithoutdetaching($sync_ids);

                $crawlerItem->timestamps = false;
                $crawlerItem->whereIn('ci_id', $crawlerItem_ids)->update(['created_at' => now()]);

                //批量儲存Shop
                $crawlerShop = new CrawlerShop();
                $TF = (new MemberCoreRepository())->massUpdate($crawlerShop, $row_shops);

                dispatch((new CrawlerTaskJob())->onQueue('high'));
                dispatch((new CrawlerItemJob())->onQueue('low'));
                dispatch((new CrawlerShopJob())->onQueue('low'));
            }
            $crawlerTask->updated_at = now();
            $crawlerTask->save();
        }
    }
}
