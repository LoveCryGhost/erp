<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\Product_SKURequest;
use App\Models\SKU;
use App\Services\Member\Product_SKUService;
use Illuminate\Http\Request;



class Product_SKUsController extends MemberCoreController
{


    public $product_SKUService;

    public function __construct(Product_SKUService $product_SKUService)
    {
        $this->middleware('auth:member');
        $this->product_SKUService= $product_SKUService;
    }

    public function create(Request $request)
    {
        $product= $this->product_SKUService->productRepo->getById($request->input('p_id'));
        $view = view(config('theme.member.view').'product.productSku.md-create', compact('product'))->render();
        return response()->json([
            'errors' => '',
            'models'=> [],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ],200);
    }

    public function store(Product_SKURequest $request)
    {
        $data = $request->all();
        $sku =$this->product_SKUService->store($data);

        $sku = $this->product_SKUService->skuRepo->getById($sku->sku_id);

        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

    public function edit(Request $request, SKU $product_sku)
    {
        $sku = $product_sku;
        $view = view(config('theme.member.view').'product.productSku.md-edit', compact('sku'))->render();
        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
            ],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }



    public function update(Product_SKURequest $request)
    {
        $data = $request->all();
        $sku = $this->product_SKUService->skuRepo->getById($data['sku_id']);
        $TF = $this->product_SKUService->update($sku, $data);
        $sku = $this->product_SKUService->skuRepo->getById($data['sku_id']);
        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

//
//    public function destroy(Attribute $attribute)
//    {
//        $toast = $this->attributeService->destroy($attribute);
//        return redirect()->route('member.attribute.index')->with('toast', $toast);
//    }
}
