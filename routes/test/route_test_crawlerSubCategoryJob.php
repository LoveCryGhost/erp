<?php

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerCategory;
use Carbon\Carbon;
use App\Repositories\Member\MemberCoreRepository;
use App\Models\CrawlerTask;
use DB;
Route::prefix('test') ->middleware('auth:admin')->group(function(){
    Route::get('crawlerSubCategoryJob',function () {
        $this->shopeeHandler = new ShopeeHandler();
        //國家
        $sub_domain = current(explode('.', request()->getHost()));
        $sub_domain = explode('-', $sub_domain)[0];

        if($sub_domain=='localhost' or $sub_domain == 'test'){
            $params['pages'] = 1;
            $params['limit_tasks']=6;
            $sub_domain='id';
        }else{
            $params['pages'] = 5;
            $params['limit_tasks']=1000;
        }

        //找出要update的 CrawlerCategory
        $crawlerCategory = CrawlerCategory::where('p_id',0)
            ->whereDate('updated_at','<>',Carbon::today())->orWhereNull('updated_at')
            ->where('locale', $sub_domain) //國家
            ->first();

        if($crawlerCategory){
            $countries = $this->shopeeHandler->crawlerSeperator_coutnry();
            foreach ($countries as $country_code => $country){
                //https://shopee.co.id/api/v0/search/api/facet/?match_id=157&page_type=search
                $url = 'https://'.$country.'/api/v0/search/api/facet/?match_id='.$crawlerCategory->catid.'&page_type=search';
                //$this->crawler_subCatergory($country_code, $country, $url, $params);

                //Category url
                //先找主Category 資料
                $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
                $json = json_decode($ClientResponse->getBody(), true);

                //寫入資料庫
                foreach ($json['facets'][0]['category']['parent_category_name']['child_catids'] as $subCategory_id){
                    $p_id = $json['facets'][0]['category']['parent_category_name']['catid'];
                    $display_name = "subCategory";
                    $row_categories[]=[
                        'catid' => $subCategory_id,
                        'p_id' => $p_id,
                        'display_name' => $display_name,
                        'image' => "",
                        'locale' => $country_code,
                        'updated_at' =>  Carbon::now(),
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
            }
        }



    });
});


