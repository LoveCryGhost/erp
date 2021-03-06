<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Request;
use App\Models\CrawlerTaskItemSKU;
use App\Models\SKU;
use App\Repositories\Member\ProductRepository;
use App\Services\Member\CrawlerItemSKUService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function strlen;
use function substr;

class CrawlerItem_CrawlerItemSKUsController extends MemberCoreController
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
//            if(strlen($crawlerItemSKU->name)>30){
//                $skuName =  substr($crawlerItemSKU->name,0,30).'...';
//            }else{
//                $skuName =  $crawlerItemSKU->name;
//            }
            $amCharProvider[] = [
                "sku_name" => $crawlerItemSKU->name,
                'sold' => $crawlerItemSKU->sold
            ];
        }


        $view = view(config('theme.member.view').'crawlerItem.crawlerItemSKU.index',compact('data', 'crawlerItem', 'amCharProvider', 'products'))->render();
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
    public function putProductId()
    {
        Session::put('member_crawlerItem_product_id', request()->product_id );
    }

    /*
     *
     * */
    public function showProductSkus()
    {
        $data = request()->all();
        $product_id = Session::get('member_crawlerItem_product_id');
        $product = $this->crawlerItemSKUService->productRepo->getById($product_id);
        $skus = $product->all_skus;
        $view = view(config('theme.member.view').'crawlerItem.crawlerItemSKU.productSKU.md-index',compact('data','skus'))->render();
        return [
            'errors' => '',
            'models'=> [
                    'skus' => $skus,
                ],
            'request' => request()->all(),
            'view' => $view,
            'options' => [ ]
        ];
    }

    /*
     *
     * */
    public function bindProductSkuToCrawlerSku(){

        if(!Session::has('member_crawlerItem_product_id')){
            return false;
        }
        $data = request()->all();
        //取消
        if($data['sku_id']=="undefined"){
            CrawlerTaskItemSKU::where(
                [
                    'ct_i_id' => $data['ct_i_id'],
                    'itemid' => $data['itemid'],
                    'shopid' => $data['shopid'],
                    'modelid' => $data['modelid'],
                ]
            )->delete();
        //update or create
        }else{
            CrawlerTaskItemSKU::updateOrCreate([
                'ct_i_id' => $data['ct_i_id'],
                'itemid' => $data['itemid'],
                'shopid' => $data['shopid'],
                'modelid' => $data['modelid'],
                'member_id' => Auth::guard('member')->user()->id,
            ],[
                'sku_id' =>  $data['sku_id']
            ]);
        }



        return [
            'errors' => '',
            'models'=> [],
            'request' => request()->all(),
            'view' => "",
            'options' => [ ]
        ];
    }

}
