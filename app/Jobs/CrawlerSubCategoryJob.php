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
use function current;
use function dispatch;
use function explode;
use function json_decode;
use function redirect;
use function request;

class CrawlerSubCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    private $shopeeHandler;
    public $timeout = 0;

    public function __construct()
    {
        $this->shopeeHandler = new ShopeeHandler();
    }

    //處理的工作
    public function handle()
    {
        $this->shopeeHandler = new ShopeeHandler();
        //國家
        $sub_domain = current(explode('.', request()->getHost()));
        $sub_domain = explode('-', $sub_domain)[0];

        if($sub_domain=='localhost' or $sub_domain == 'test'){
            $params['pages'] = 1;
            $params['limit_tasks']=1000;
            $sub_domain='id';
        }else{
            $params['pages'] = 10;
            $params['limit_tasks']=1000;
        }


        //找出要update的 CrawlerCategory
        $crawlerCategory = CrawlerCategory::where('p_id', '=' ,0)
            ->where(function($query)
            {
                $query->whereDate('updated_at','<>', Carbon::today())
                    ->orWhereNull('updated_at');
            })
            ->where('locale', $sub_domain) //國家
            ->first();
        if($crawlerCategory){
            $countries = $this->shopeeHandler->crawlerSeperator_coutnry();

            foreach ($countries as $country_code => $country){
                //https://shopee.co.id/api/v0/search/api/facet/?match_id=157&page_type=search
                $url = 'https://'.$country.'/api/v0/search/api/facet/?match_id='.$crawlerCategory->catid.'&page_type=search';
                $this->crawler_subCatergory($country_code, $country, $url, $params);
            }

            DB::table('crawler_categories')
                ->where(['p_id'=>0, 'locale' => $sub_domain, 'catid'=> $crawlerCategory->catid])
                ->update(['updated_at'=> Carbon::now()]);

            dispatch((new CrawlerSubCategoryJob())->onQueue('instant'));
        }
        return redirect()->back();
    }

    public function crawler_subCatergory($country_code, $country, $url, $params=[])
    {
        //Category url
        //先找主Category 資料
        $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
        $json = json_decode($ClientResponse->getBody(), true);

        //寫入資料庫
        foreach ($json['facets'][0]['category']['parent_category_name']['child_catids'] as $subCategory_id){
            $p_id = $json['facets'][0]['category']['parent_category_name']['catid'];

            //找displayName
            $display_name = "subCategory";
            foreach($json['facets'] as $key => $subCategory){
                $subCategory['catid'] == $subCategory_id;
                $display_name = $subCategory['category']['display_name'];
            }


            $row_categories[]=[
                'catid' => $subCategory_id,
                'p_id' => $p_id,
                'display_name' => $display_name,
                'image' => "",
                'locale' => $country_code,
                'updated_at' => null,
                'created_at' => Carbon::now()
            ];

            //https://shopee.co.id/Makanan&Minuman-cat.157?page=0&sortBy=sales
            $row_crawlerTasks[]=[
                "is_active" => 1,
                "ct_name" =>  $display_name,
                "url" => "https://".$country."/".$display_name."-cat.".$p_id.".".$subCategory_id."?sortBy=sales",
                "pages" => $params['pages'],
                "description" => "",
                'display_name' => $display_name
            ];
            $row_crawlerTasks[]=[
                "is_active" => 1,
                "ct_name" =>  $display_name,
                "url" => "https://".$country."/".$display_name."-cat.".$p_id.".".$subCategory_id."?sortBy=sales&locations=-2",
                "pages" => $params['pages'],
                "description" => "",
                'display_name' => $display_name
            ];
        }


        //Update CrawlerCategories
        $crawlerCategory = new CrawlerCategory();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerCategory, $row_categories);

        $index=0;
        foreach($row_crawlerTasks as $row_crawlerTask){
            if($index >= $params['limit_tasks']){
                break;
            }
            $url_params = $this->shopeeHandler->shopee_url($row_crawlerTask['url']);
            $data['url_params'] = $url_params;
            $data['locale'] = $data['url_params']['locale'];
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
            }else{
                $data['locations'] = NULL;
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
                'subcategory' => $data['subcategory'],
                'domain_name' => $data['domain_name'],
                'locale' => $data['url_params']['locale'],
                'sort_by' => $data['sort_by'],
                'locations' => $data['locations']
            ],[
                'is_active' => 1,
                'ct_name' => 'SubCat. - '.$row_crawlerTask['display_name'],
                'website' => $data['url_params']['website'],
                'url' => $data['url_params']['url'],
                'member_id' =>  $data['locations']==-2?  5:3,
                'pages' => $row_crawlerTask['pages'],
                'is_crawler' => 1
            ]);

            $index++;
        }
    }
}
