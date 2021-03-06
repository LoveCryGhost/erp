<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerShop;
use App\Repositories\Member\MemberCoreRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use function current;
use function explode;
use function request;

class CrawlerShopJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $shopeeHandler;

    public function __construct()
    {
        $this->shopeeHandler = new ShopeeHandler();
    }

    //多次請求網址
    public function handle()
    {
        $member_id = Auth::guard('member')->check()?  Auth::guard('member')->user()->id: '1';

        $query = CrawlerShop::whereNull('updated_at')->take(config('crawler.update_shop_qty'));
        $query = $this->shopeeHandler->crawlerSeperator($query);
        $crawler_shops = $query->whereDate('updated_at','<>',Carbon::today())->orWhereNull('updated_at')->get();

        if(count($crawler_shops)>0) {
            foreach ($crawler_shops as $crawler_shop){
                $url = 'https://'.$crawler_shop->domain_name.'/api/v2/shop/get?shopid='.$crawler_shop->shopid;
                $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
                $json = json_decode($ClientResponse->getBody(), true);

                $row_shop[]=[
                    'shopid' => $crawler_shop->shopid,
                    'username' => $json['data']['account']['username'],
                    'shop_location' => $json['data']['shop_location'],
                    'domain_name' => $crawler_shop->domain_name,
                    'locale' => $crawler_shop->locale,
                    'member_id' => $member_id,
                    'updated_at'=>Carbon::now()
                ];
            }

            //Update CrawlerShop
            $crawlerShop = new CrawlerShop();
            $TF = (new MemberCoreRepository())->massUpdate($crawlerShop, $row_shop);
            dispatch((new CrawlerShopJob())->onQueue('low'));
        }
    }
}
