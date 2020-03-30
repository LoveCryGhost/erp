<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Request;
use App\Services\Member\CrawlerItemSKUService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function request;

class CrawlerItemSKUsController extends MemberCoreController
{
    private $crawlerItemSKUService;
    public function __construct(CrawlerItemSKUService $crawlerItemSKUService)
    {
        $this->middleware('auth:member');
        $this->crawlerItemSKUService = $crawlerItemSKUService;
    }

    public function index()
    {
        $data = request()->all();
        $crawlerItem = $this->crawlerItemSKUService->crawlerItemRepo->getById($data['ci_id']);

        //Member本身的商品
        $products = $this->crawlerItemSKUService->productRepo->builder()
                            ->where('member_id', Auth::guard('member')->user()->id)->get();

        foreach($crawlerItem->crawlerItemSKUs as $crawlerItemSKU){
            $amCharProvider[] = [
                "year" => $crawlerItemSKU->name,
                'sold' => $crawlerItemSKU->sold
            ];
        }

        $view = view(config('theme.member.view').'crawlerItemSKU.index',compact('data', 'crawlerItem', 'amCharProvider', 'products'))->render();
        return [
            'errors' => '',
            'models'=> [
                'crawlerItem' => $crawlerItem,
            ],
            'request' => request()->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

    /*
     * CrawlerItemSKU中選定Product -> Product-id
     * */
    public function put_product_id()
    {
        Session::put('member_crawleritem_product_id', request()->product_id );
    }
}
