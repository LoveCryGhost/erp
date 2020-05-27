<?php

use App\Handlers\BarcodeHandler;
use App\Handlers\ShopeeHandler;
use App\Models\CrawlerTask;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class CrawlerTaskTableSeeder extends Seeder
{
    public function run()
    {
        $crawlerTasks = [
            [
                'ct_name' => 'Pizza pan',
                'url' => 'https://shopee.co.id/search?keyword=Pizza pan&sortBy=sales',
                'pages' => "6",
                "sort_by" => "sales",
                'description' => "",
                'member_id' => 1
            ],
            [
                'ct_name' => 'Loyang Muffin',
                'url' => 'https://shopee.co.id/search?keyword=Loyang Muffin&sortBy=sales',
                'pages' => "6",
                "sort_by" => "sales",
                'description' => "",
                'member_id' => 1
            ],
//            [
//                'ct_name' => 'Loyang Loaf Pan',
//                'url' => 'https://shopee.co.id/search?keyword=Loyang Loaf Pan&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 2
//            ],
//            [
//                'ct_name' => 'Loyang Square Cake pan',
//                'url' => 'https://shopee.co.id/search?keyword=Loyang Square Cake pan&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 2
//            ],
//            [
//                'ct_name' => 'Loyang Round Cake',
//                'url' => 'https://shopee.co.id/search?keyword=Loyang Round Cake&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 2
//            ],
//
//            [
//                'ct_name' => 'SPRING FORM',
//                'url' => 'https://shopee.co.id/search?keyword=SPRING FORM&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 2
//            ],
//            [
//                'ct_name' => 'Loyang BONGPAS',
//                'url' => 'https://shopee.co.id/search?keyword=Loyang BONGPAS&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 2
//            ],
//            [
//                'ct_name' => 'Loyang Chiffon',
//                'url' => 'https://shopee.co.id/search?keyword=Loyang Chiffon&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 2
//            ],
//            [
//                'ct_name' => 'loyang tulban',
//                'url' => 'https://shopee.co.id/search?keyword=loyang tulban&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 2
//            ],
//            [
//                'ct_name' => 'Pizza pan',
//                'url' => 'https://shopee.co.id/search?keyword=Pizza pan&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 5
//            ],
//            [
//                'ct_name' => 'Loyang Muffin',
//                'url' => 'https://shopee.co.id/search?keyword=Loyang Muffin&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 5
//            ],
//            [
//                'ct_name' => 'Loyang Loaf Pan',
//                'url' => 'https://shopee.co.id/search?keyword=Loyang Loaf Pan&sortBy=sales',
//                'pages' => "6",
//                "sort_by" => "sales",
//                'description' => "",
//                'member_id' => 5
//            ],


        ];

        foreach($crawlerTasks as $data){
            $url = $data['url'];
            $url_params = (new ShopeeHandler())->shopee_url($url);
            $data['url_params'] = $url_params;
            $data['locale'] = $data['url_params']['locale'];
            $data['domain_name'] = $data['url_params']['domain_name'];
            if(isset( $data['url_params']['gets']['sortBy'])){
                $data['sort_by'] = $data['url_params']['gets']['sortBy'];
            }else{
                $data['sort_by'] = 'sales';
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

            $crawlerTask = new CrawlerTask();

            $crawlerTask->is_active=1;
            $crawlerTask->sort_order=0;
            $crawlerTask->ct_name = $data['ct_name'];
            $crawlerTask->url = $data['url'];
            $crawlerTask->domain_name = $data['domain_name'];
            $crawlerTask->pages = $data['pages'];
            $crawlerTask->locale = $data['locale'];
            $crawlerTask->category = isset($data['category'])? $data['category']: null;
            $crawlerTask->subcategory = isset($data['subcategory'])? $data['subcategory']: null;
            $crawlerTask->sort_by = isset($data['sort_by'])? $data['sort_by']: null;
            $crawlerTask->keyword = isset($data['keyword'])? $data['keyword']: null;
            $crawlerTask->order = isset($data['order'])? $data['order']: "";
            $crawlerTask->locations = isset($data['locations'])? $data['locations']: null;
            $crawlerTask->ratingFilter = isset($data['ratingFilter'])? $data['ratingFilter']: null;
            $crawlerTask->facet = isset($data['facet'])? $data['facet']: null;
            $crawlerTask->shippingOptions = isset($data['shippingOptions'])? $data['shippingOptions']: null;
            $crawlerTask->wholesale = isset($data['wholesale'])? $data['wholesale']: null;
            $crawlerTask->officialMall = isset($data['officialMall'])? $data['officialMall']: null;
            $crawlerTask->description = isset($data['description'])? $data['description']: null;
            $crawlerTask->member_id = $data['member_id'];
            $crawlerTask->save();
        }
    }
}
