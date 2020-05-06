<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerCategory;
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
use function dispatch;
use function json_decode;

class CrawlerCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    private $shopeeHandler;

    public function __construct()
    {
        $this->shopeeHandler = new ShopeeHandler();
    }

    //處理的工作
    public function handle()
    {
        $this->shopeeHandler = new ShopeeHandler();
        //國家
        $countries = ['shopee.tw','shopee.co.id', 'shopee.co.th'];
        foreach ($countries as $country){
            $url = 'https://'.$country.'/api/v2/category_list/get';
            $this->crawler_catergory($url);
        }
    }

    public function crawler_catergory($url)
    {
        //Category url
        $category_url = $url ;
        //先找主Category 資料
        $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($category_url);
        $json = json_decode($ClientResponse->getBody(), true);

        //寫入資料庫
        foreach ($json['data']['category_list'] as $category){
            $row_categories[]=[
                'catid' => $category['catid'],
                'p_id' => 0,
                'display_name' => $category['display_name'],
                'image' => $category['image'],
                'local' => 'tw',
            ];

            //https://shopee.co.id/Makanan&Minuman-cat.157?page=0&sortBy=sales
            $row_crawlerTasks[]=[
                "is_active" => 1,
                "ct_name" =>  $category['display_name'],
                "url" => "https://shopee.tw/".$category['display_name']."-cat.".$category['catid']."?sortBy=sales",
                "pages" => 1,
                "description" => "",
                'display_name' => $category['display_name']
            ];
        }
        //Update CrawlerCategories
        $crawlerCategory = new CrawlerCategory();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerCategory, $row_categories);


        foreach($row_crawlerTasks as $row_crawlerTask){
            $url_params = $this->shopeeHandler->shopee_url($row_crawlerTask['url']);
            $data['url_params'] = $url_params;
            $data['local'] = $data['url_params']['local'];
            $data['domain_name'] = $data['url_params']['domain_name'];
            if(isset( $data['url_params']['gets']['sortBy'])){
                $data['sort_by'] = $data['url_params']['gets']['sortBy'];
            }else{
                $data['sort_by'] = 'relevancy';
            }
            if(isset( $data['url_params']['gets']['category'])){
                $data['category'] = $data['url_params']['gets']['category'];
            }
            if(isset( $data['url_params']['gets']['subcategory'])){
                $data['subcategory'] = $data['url_params']['gets']['subcategory'];
            }
            if(isset( $data['url_params']['gets']['keyword'])){
                $data['keyword'] = $data['url_params']['gets']['keyword'];
            }

            if(isset( $data['url_params']['gets']['order'])){
                $data['order'] = $data['url_params']['gets']['order'];
            }

            if(isset( $data['url_params']['gets']['locations'])){
                $data['locations'] = $data['url_params']['gets']['locations'];
            }
            if(isset( $data['url_params']['gets']['ratingFilter'])){
                $data['ratingFilter'] = $data['url_params']['gets']['ratingFilter'];
            }
            if(isset( $data['url_params']['gets']['facet'])){
                $data['facet'] = $data['url_params']['gets']['facet'];
            }
            if(isset( $data['url_params']['gets']['shippingOptions'])){
                $data['shippingOptions'] = $data['url_params']['gets']['shippingOptions'];
            }
            if(isset( $data['url_params']['gets']['officialMall'])){
                $data['officialMall'] = $data['url_params']['gets']['officialMall'];
            }

            //新增爬蟲任務
            CrawlerTask::updateOrCreate([
                'category' => $data['category'],
                'domain_name' => $data['domain_name'],
                'local' => $data['local'],
                'sort_by' => $data['sort_by']
            ],[
                'is_active' => 1,
                'ct_name' => '分類 - '.$row_crawlerTask['display_name'],
                'website' => $data['url_params']['website'],
                'url' => $data['url_params']['url']
            ]);
        }
        //dispatch((new CrawlerTaskJob())->onQueue('high'));
    }
}
