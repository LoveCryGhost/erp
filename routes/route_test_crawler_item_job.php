<?php

use App\Handlers\ShopeeHandler;
use App\Jobs\CrawlerItemJob;
use App\Models\CrawlerItem;
use App\Repositories\Member\MemberCoreRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/shopee-crawleritem', function () {

    $this->shopeeHandler = new ShopeeHandler();
    $member_id = Auth::guard('member')->check()?  Auth::guard('member')->user()->id: '1';

    $crawler_items = CrawlerItem::where(function ($query) {
        $query->whereDate('updated_at','<>',Carbon::today())->orWhereNull('updated_at');
    })->take(config('crawler.update_item_qty'))->get();
    if(count($crawler_items)>0){
        foreach ($crawler_items as $crawler_item){
            $url = 'https://'.$crawler_item->domain_name.'/api/v2/item/get?itemid='.$crawler_item->itemid.'&shopid='.$crawler_item->shopid;
            $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
            $json = json_decode($ClientResponse->getBody(), true);

            //CrawlerItem
            $row_item[]=[
                'itemid' => $crawler_item->itemid,
                'shopid' => $crawler_item->shopid,
                'name' => $json['item']['name'],
                'images' => $json['item']['images'][0],
                'sold' => $json['item']['sold'],
                'historical_sold' => $json['item']['historical_sold'],
                'domain_name' => '2222',
                'local' => $crawler_item->local,
                'member_id' => $member_id,
                'updated_at'=> now()
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
        }

        //重新指派任務
        dispatch((new CrawlerItemJob())->onQueue('low'));
    }
});


