<?php

namespace App\Services\Member;

use App\Handlers\ShopeeHandler;
use App\Repositories\Member\AttributeRepository;
use App\Repositories\Member\CrawlerTaskRepository;
use App\Repositories\Member\TypeRepository;
use Illuminate\Support\Facades\Auth;

class CrawlerTaskService extends MemberCoreService implements MemberServiceInterface
{

    public $crawlertaskRepo;
    private $shopeeHandler;

    public function __construct(CrawlerTaskRepository $crawlerTaskRepository, ShopeeHandler $shopeeHandler)
    {
        $this->crawlertaskRepo = $crawlerTaskRepository;
        $this->shopeeHandler = $shopeeHandler;
    }

    public function index()
    {
        $crawlerTasks = $this->crawlertaskRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)
            ->with(['member'])->paginate(10);
        return $crawlerTasks;
    }

    public function create()
    {
    }



    public function edit()
    {

    }

    public function store($data)
    {
        $url = $data['url'];
        $url_params = (new ShopeeHandler())->shopee_url($url);
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

        return $this->crawlertaskRepo->builder()->create($data);
    }

    public function update($model,$data)
    {
        $crawlerTask = $model;
        return $crawlerTask->update($data);
    }

    public function destroy($model, $data)
    {
        $crawlertask = $model;
        return $crawlertask->delete();
    }




}
