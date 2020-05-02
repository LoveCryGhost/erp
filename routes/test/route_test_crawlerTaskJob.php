<?php

use App\Handlers\ShopeeHandler;
use App\Jobs\CrawlerItemJob;
use App\Jobs\CrawlerShopJob;
use App\Jobs\CrawlerTaskJob;
use App\Models\CrawlerItem;
use App\Models\CrawlerShop;
use App\Models\CrawlerTask;
use App\Repositories\Member\MemberCoreRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('test') ->middleware('auth:admin')->group(function(){
    Route::get('crawlerTaskJob',function () {

        //先找Task
        $crawlerTask = CrawlerTask::find(13);
        //組合Url連結組合
        $this->shopeeHandler = new ShopeeHandler();
        $urls = $this->shopeeHandler->crawlerTaskGenerateAPIUrl($crawlerTask);

        //更新所 - Url
        foreach ($urls as $url) {
            $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
            $json = json_decode($ClientResponse->getBody(), true);
            dd($json);
            //指定使用者
            $member_id = Auth::guard('member')->check() ? Auth::guard('member')->user()->id : '1';
            foreach ($json['items'] as $item) {

                //商品資訊
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

                //商店資訊
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


            dd($row_items);
            //批量儲存Item
            $crawlerItem = new CrawlerItem();
            $TF = (new MemberCoreRepository())->massUpdate($crawlerItem, $row_items);

            //這次抓到的商品id 還有順序
            $crawlerItem_ids = CrawlerItem::whereInMultiple(['itemid', 'shopid', 'local'], $value_arr)
                ->pluck('ci_id', 'itemid');


            $index=1;
            foreach ($items_order as $itemid){
                $sync_ids[$crawlerItem_ids[$itemid]]= ['sort_order'=>$index++];
            }

            //Sync刪除並更新
            $crawlerTask->crawlerItems()->sync($sync_ids);

            //$crawlerItem->timestamps = false;
            //$crawlerItem->whereIn('ci_id', $crawlerItem_ids)->update(['created_at' => now()]);

            //批量儲存Shop
            $crawlerShop = new CrawlerShop();
            $TF = (new MemberCoreRepository())->massUpdate($crawlerShop, $row_shops);

            dispatch((new CrawlerTaskJob())->onQueue('high'));
            dispatch((new CrawlerItemJob())->onQueue('low'));
            dispatch((new CrawlerShopJob())->onQueue('low'));
        }
        $crawlerTask->updated_at = Carbon::now();
        $crawlerTask->save();
    });
});


