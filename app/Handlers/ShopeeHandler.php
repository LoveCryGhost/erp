<?php

namespace App\Handlers;

use GuzzleHttp\Client;

class ShopeeHandler
{
    public function ClientHeader_Shopee($url){
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'x-api-source' => 'pc',
            ]
        ]);
        while($response->getStatusCode()!=200){
            $response = $client->request('GET', $url, [
                'headers' => [
                    'x-api-source' => 'pc',
                ]
            ]);
        }
        return $response;
    }

    public function shopee_url($url){

        $params = (new StringHandler())->url($url);


        //Shopee網址

        //local
        switch ($shopee_url = $params['domain_name']){
            case "shopee.tw":
                $params['local'] = 'tw';
                break;

            case "shopee.co.id":
                $params['local'] = 'id';
                break;

            case "shopee.co.th":
                $params['local'] = 'th';
                break;

            case "shopee.com.my":
                $params['local'] = 'my';
                break;

            default;
                $params['local'] = null;
                break;
        }

        //cat
        $cat = explode("-cat.",explode('/',$params['website'])[1]);
        if(count($cat)==2){
            //是否有sub cat
            $sub_cat = explode('.', $cat[1]);
            if(count($sub_cat)==2){
                $params['gets']['category'] = $sub_cat[0];
                $params['gets']['subcategory'] = $sub_cat[1];
            }else{
                $params['gets']['category'] = $cat[1];
            }
        }

        return $params;
    }

    public function crawlerTaskGenerateAPIUrl($crawlerTask)
    {
        //爬蟲
        $item_qty = $crawlerTask->pages*50;
        $insert_item_qty = config('crawler.insert_item_qty');
        $index = ceil($item_qty/$insert_item_qty);
        for ($i=0; $i<=$index-1; $i++){
            $url =   'https://'.$crawlerTask->domain_name.'/api/v2/search_items/?';

            if(!is_null($crawlerTask->sort_by)){
                $url.= '&by='.$crawlerTask->sort_by;
            }

            $url.=   '&limit='.$insert_item_qty;
            $url.=   '&newest='.($i*$insert_item_qty);


            if(!is_null($crawlerTask->locations)){
                $url.= '&locations='.$crawlerTask->locations;
            }

            if(!is_null($crawlerTask->subcategory)){
                $url.=   '&fe_categoryids='.$crawlerTask->subcategory;
            }elseif(!is_null($crawlerTask->category)){
                $url.=   '&fe_categoryids='.$crawlerTask->category;
            }

            if(!is_null($crawlerTask->facet)){
                $url.= '&categoryids='.$crawlerTask->facet;
            }
            if(!is_null($crawlerTask->ratingFilter)){
                $url.= '&rating_filter='.$crawlerTask->ratingFilter;
            }
            if(!is_null($crawlerTask->wholesale)){
                $url.= '&wholesale='.$crawlerTask->wholesale;
            }
            if(!is_null($crawlerTask->shippingOptions)){
                $url.= '&shippings='.$crawlerTask->shippingOptions;
            }
            if(!is_null($crawlerTask->officialMall)){
                $url.= '&official_mall='.$crawlerTask->officialMall;
            }
            if(!is_null($crawlerTask->keyword)){
                $url.= '&keyword='.$crawlerTask->keyword;
            }

            if(!is_null($crawlerTask->order)){
                $url.= '&order='.$crawlerTask->order;
            }

            $url.=   '&page_type=search';
            $url.=   '&version=2';

            $urls[] = $url;
        }

        return $urls;
    }
}
