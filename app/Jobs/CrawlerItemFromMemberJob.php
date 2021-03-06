<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerItem;
use App\Models\CrawlerItemSKU;
use App\Models\CrawlerItemSKUDetail;
use App\Models\CrawlerTask;
use App\Repositories\Member\MemberCoreRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use function config;
use function current;
use function explode;
use function request;

class CrawlerItemFromMemberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $shopeeHandler;

    public function __construct()
    {
        $this->shopeeHandler = new ShopeeHandler();
    }

    //處理的工作
    public function handle()
    {

        $member_id = Auth::guard('member')->check()?  Auth::guard('member')->user()->id: '1';


        $query = CrawlerItem::whereHas('crawlerTask', function ($query) {
            $query->where('member_id', '>', 5)
                ->orderBy('member_id', 'DESC');
            })
            ->where(function ($query) {
                $query->whereDate('updated_at','<>',Carbon::today())->orWhereNull('updated_at');
            })
            ->orderBy('ci_id', 'ASC')
            ->take(config('crawler.update_item_qty'));

        $query = $this->shopeeHandler->crawlerSeperator($query);
        $crawler_items = $query->get();

        if(count($crawler_items)>0){
            foreach ($crawler_items as $crawler_item){
                $url = 'https://'.$crawler_item->domain_name.'/api/v2/item/get?itemid='.$crawler_item->itemid.'&shopid='.$crawler_item->shopid;
                $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
                $json = json_decode($ClientResponse->getBody(), true);

                //若商品為空或是已經被Shopee刪除了
                if($json['item']){
                    //CrawlerItem
                    $row_item[]=[
                        'itemid' => $crawler_item->itemid,
                        'shopid' => $crawler_item->shopid,
                        'name' => $json['item']['name'],
                        'images' => $json['item']['images'][0],
                        'sold' => $json['item']['sold']==null? 0: $json['item']['sold'],
                        'historical_sold' => $json['item']['historical_sold']==null? 0: $json['item']['historical_sold'],
                        'domain_name' => $crawler_item->domain_name,
                        'locale' => $crawler_item->locale,
                        'member_id' => $member_id,
                        'updated_at'=> Carbon::now()
                    ];

                    //Update CrawlerItem
                    $crawlerItem = new CrawlerItem();
                    $TF = (new MemberCoreRepository())->massUpdate($crawlerItem, $row_item);

                    //CrawlerItemSKU
                    if(count($json['item']['models'])>0){
                        $this->row_model_details($json, $crawler_item);
                    }else{
                        $this->row_item_detail($json, $crawler_item);
                    }

                //若商品為空或是已經被Shopee刪除了
                }else{
                    $crawler_item->updated_at = Carbon::now();
                    $crawler_item->is_active = 0;
                    $crawler_item->save();
                }

            }

            //重新指派任務
            dispatch((new CrawlerItemFromMemberJob())->onQueue('high'));
        }
    }

    public function row_model_details($json, $crawler_item){
        foreach ($json['item']['models'] as $model){
            $row_item_models[] = [
                'ci_id' => $crawler_item->ci_id,
                'shopid' => $json['item']['shopid'],
                'itemid' => $model['itemid'],
                'modelid' => $model['modelid'],
                'name' => $model['name'],
                'price' => $model['price'],
                'locale' => 'tw',
                'sold' => $model['sold'],
                'stock' => $model['stock'],
            ];
            $row_item_model_details[] = [
                'shopid' => $json['item']['shopid'],
                'itemid' => $model['itemid'],
                'modelid' => $model['modelid'],
                'price' => $model['price'],
                'price_before_discount' => $model['price_before_discount'],
                'sold' => $model['sold'],
                'stock' => $model['stock'],
                'created_at' => Carbon::now()
            ];
        }

        //UpdateOrCreate CrawlerItemSKU
        $crawlerItemSKU = new CrawlerItemSKU();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerItemSKU, $row_item_models);

        //UpdateOrCreate CrawlerItemSKUDetail
        $crawlerItemSKUDetail = new CrawlerItemSKUDetail();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerItemSKUDetail, $row_item_model_details);
    }

    public function row_item_detail($json, $crawler_item){


        $row_item_modes[] = [
            'ci_id' => $crawler_item->ci_id,
            'shopid' => $json['item']['shopid'],
            'itemid' => $json['item']['itemid'],
            'modelid' => $json['item']['itemid'],
            'name' => $json['item']['name'],
            'price' => $json['item']['price'],

            'sold' => $json['item']['sold'],
            'stock' => $json['item']['stock'],
            'locale' => $crawler_item->locale,
        ];
        $row_item_mode_details[] = [
            'shopid' => $json['item']['shopid'],
            'itemid' => $json['item']['itemid'],
            'modelid' => $json['item']['itemid'],
            'price' => $json['item']['price'],
            'price_before_discount' => $json['item']['price_before_discount'],
            'sold' => $json['item']['sold'],
            'stock' => $json['item']['stock'],
            'created_at' => Carbon::now()
        ];

        //UpdateOrCreate CrawlerItemSKU
        $crawlerItemSKU = new CrawlerItemSKU();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerItemSKU, $row_item_modes);

        //UpdateOrCreate CrawlerItemSKUDetail
        $crawlerItemSKUDetail = new CrawlerItemSKUDetail();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerItemSKUDetail, $row_item_mode_details);
    }

}
