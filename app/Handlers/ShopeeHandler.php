<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use function current;
use function dd;
use function explode;
use function request;

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
                $params['locale'] = 'tw';
                break;

            case "shopee.co.id":
                $params['locale'] = 'id';
                break;

            case "shopee.co.th":
                $params['locale'] = 'th';
                break;


            default;
                $params['locale'] = null;
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

    //組合Url連結
    public function crawlerTaskGenerateAPIUrl($crawlerTask)
    {
        //爬蟲
        $item_qty = $crawlerTask->pages*50;
        $insert_item_qty = config('crawler.insert_item_qty');
        $index = ceil($item_qty/$insert_item_qty);

        $url =   'https://'.$crawlerTask->domain_name.'/api/v2/search_items/?';

        if(!is_null($crawlerTask->sort_by)){
            $url.= '&by='.$crawlerTask->sort_by;
        }

        $url.=   '&limit='.$insert_item_qty;
        //$url.=   '&newest='.($i*$insert_item_qty);
        $url.=   '&newest='.($crawlerTask->current_page*$insert_item_qty);

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

        return $urls;
    }

    public function crawlerSeperator($query)
    {
        $sub_domain = current(explode('.', request()->getHost()));
        $sub_domain = explode('-', $sub_domain)[0];
        if($sub_domain=='tw'){
            $query = $query->where('locale', 'tw');
        }elseif($sub_domain=='id'){
            $query = $query->where('locale', 'id');
        }elseif($sub_domain=='th'){
            $query = $query->where('locale', 'th');
        }elseif($sub_domain=='my'){
            $query = $query->where('locale', 'my');
        }elseif($sub_domain=='test' or $sub_domain=='localhost' ){
            $query = $query;
        }else{
            $query = $query->where('locale', 'None');
        }
        return $query;
    }

    public function crawlerSeperator_coutnry()
    {
        $sub_domain = current(explode('.', request()->getHost()));
        $sub_domain = explode('-', $sub_domain)[0];

        if($sub_domain=='tw'){
            $countries['tw'] = 'shopee.tw';
        }elseif($sub_domain=='id'){
            $countries['id'] = 'shopee.co.id';
        }elseif($sub_domain=='th'){
            $countries['th'] = 'shopee.co.th';
        }elseif($sub_domain=='localhost' or $sub_domain == 'test'){
            $countries['id'] = 'shopee.co.id';
        }else{
            $countries[] = [];
        }
        dd($countries);
        return $countries;

    }

    public function getShopeeUrl()
    {
        $shopeeUrl['tw'] = 'shopee.tw';
        $shopeeUrl['th'] = 'shopee.co.th';
        $shopeeUrl['id'] = 'shopee.co.id';
        return $shopeeUrl;

    }
}
