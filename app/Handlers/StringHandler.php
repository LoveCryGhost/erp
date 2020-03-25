<?php

namespace App\Handlers;


class StringHandler
{
    public function url($url, $options=[]){
        /*
         * https://shopee.tw/search?
         *
         * domain_name
         * https://shopee.tw
         *
         * category
         * https://shopee.tw/男裝-cat.63
         *
         * subcategory
         * https://shopee.tw/男裝-T-shirt-cat.63.1519
         * https://shopee.tw/search?category=63&keyword=長袖t恤&subcategory=1519
         *
         * facet
         * https://shopee.tw/search?category=63&facet=7799&page=0&subcategory=1519
         *
         * page
         * https://shopee.tw/search?category=63&keyword=長袖t恤&page=0&showItems=true&sortBy=sales&subcategory=1519
         *
         * keyword
         * https://shopee.tw/search?category=63&keyword=長袖t恤&order=asc&page=0&showItems=true&sortBy=price&subcategory=1519
         *
         * sortBy = ctime / sales
         * https://shopee.tw/search?category=63&keyword=長袖t恤&page=0&showItems=true&sortBy=ctime&subcategory=1519
         *
         * locations = -2 /
         * https://shopee.tw/search?category=63&keyword=長袖t恤&locations=-2&page=0&showItems=true&sortBy=ctime&subcategory=1519
         *
         * ratingFilter =  5
         * https://shopee.tw/search?category=63&keyword=長袖t恤&locations=-2&page=0&ratingFilter=5&showItems=true&sortBy=ctime&subcategory=1519
         * */

        //分析url https://shopee.com.my/Health-Beauty-cat.129?page=1&sortBy=sales


        $params =[];

        //去頭去尾
        $url = str_replace('http://',"", $url);
        $url = str_replace('https://','', $url);
        $url = str_replace('https://','', $url);

        //1切為2 => 網址 /變數
        $url_paths = explode("?",$url);

        //抓出Get的變數
        if(count($url_paths)>=2){
            $url_gets= explode("&",$url_paths[1]);

            foreach ($url_gets as $url_get){
                $url_get_arr =explode("=",$url_get);
                $params['gets'][$url_get_arr[0]]  = $url_get_arr[1];
            }
            $params['get_path'] = $url_paths[1];
        }


        $params['url'] = $url;
        $params['website'] = $url_paths[0];
        $domains = explode("/",$url_paths[0]);

        if(count($domains)>=2){
            $params['domain_name'] = $domains[0];
        }else{
            $params['domain_name'] = $url_paths;
        }


        return $params;
    }


}
