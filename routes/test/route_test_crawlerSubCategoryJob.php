<?php

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerCategory;
use Carbon\Carbon;
use App\Repositories\Member\MemberCoreRepository;
use App\Models\CrawlerTask;
use DB;
Route::prefix('test') ->middleware('auth:admin')->group(function(){
    Route::get('crawlerSubCategoryJob',function () {
        //組合Url連結組合
        $this->shopeeHandler = new ShopeeHandler();

        //國家
        $sub_domain = current(explode('.', request()->getHost()));
        if($sub_domain=='localhost' or$sub_domain == 'test'){
            $params['pages'] = 1;
            $params['limit_tasks']=1;
        }else{
            $params['pages'] = 20;
            $params['limit_tasks']=1000;
        }


        $sub_domain = current(explode('.', request()->getHost()));
        $coutries = $this->shopeeHandler->crawlerSeperator_coutnry();
        $crawlerCategories = DB::table('crawler_categories')->where('p_id',0)->orWhereNull('updated_at')
            ->take(config('crawler.insert_sub_category_qty'))->get();

        foreach($crawlerCategories as $crawlerCategory){
            $url = 'https://'.$coutries[$crawlerCategory->local].'/api/v0/search/api/facet/?fe_categoryids='.$crawlerCategory->catid.'&page_type=search';
            //'https://shopee.co.id/api/v0/search/api/facet/?fe_categoryids=32&page_type=search';
            $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
            $json = json_decode($ClientResponse->getBody(), true);
            //dd($catid, $url, $json['facets']);

                foreach($json['facets'][0]['category']['parent_category_name']['child_catids'] as $sub_category){
                    $row_categories[]=[
                        'catid' => $sub_category,
                        'p_id' => $crawlerCategory->catid,
                        'display_name' => null,
                        'image' => null,
                        'local' => $crawlerCategory->local,
                        'updated_at' => Carbon::now()
                    ];
                }



                //https://shopee.co.id/Makanan&Minuman-cat.157?page=0&sortBy=sales
                $row_crawlerTasks[]=[
                    "is_active" => 1,
                    "ct_name" =>  'SubCategory-cat',
                    "url" => "https://".$coutries[$crawlerCategory->local]."/SubCategory-cat.".$crawlerCategory->catid.'.'.$sub_category."?sortBy=sales",
                    "pages" => $params['pages'],
                    "description" => "",
                    'display_name' => 'SubCategory-cat'
                ];

            dd($json['facets'], $row_categories);
            //Update CrawlerCategories
            $TF = (new MemberCoreRepository())->massUpdate( new CrawlerCategory(), $row_categories);


            //建立CrawlerTask
            $index=0;
            foreach($row_crawlerTasks as $row_crawlerTask){
                if($index >= $params['limit_tasks']){
                    break;
                }
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
                    'local' => $data['url_params']['local'],
                    'sort_by' => $data['sort_by']
                ],[
                    'is_active' => 1,
                    'ct_name' => 'Cat. - '.$row_crawlerTask['display_name'],
                    'website' => $data['url_params']['website'],
                    'url' => $data['url_params']['url'],
                    'member_id' => 1, //default 1
                    'pages' => $row_crawlerTask['pages']
                ]);
                $index++;
            }
            DB::table('crawler_categories')
                ->where(['p_id'=>0, 'local' => $crawlerCategory->local, 'catid'=> $crawlerCategory->catid])
                ->update(['updated_at'=> Carbon::now()]);
            dd(123);
        }



    });
});


