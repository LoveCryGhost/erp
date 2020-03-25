<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\Product_SKU_SupplierRequest;
use App\Models\Supplier;
use App\Services\Member\Product_SKU_SupplierService;
use Illuminate\Http\Request;

class Product_SKU_SuppliersController extends MemberCoreController
{


    public $product_SKU_SupplierService;

    public function __construct(Product_SKU_SupplierService $product_SKU_SupplierService)
    {
        $this->middleware('auth:member');
        $this->product_SKU_SupplierService= $product_SKU_SupplierService;

    }


    public function index(Request $request)
    {
        $data = $request->all();
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        $suppliers = $this->product_SKU_SupplierService->supplierRepo->builder()->get();
        $view = view(config('theme.member.view').'product.productSku.productSkuSupplier.md-index',compact('data', 'sku', 'suppliers'))->render();
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

    public function create(Request $request)
    {
        $data = $request->all();
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        $suppliers = $this->product_SKU_SupplierService->supplierRepo->builder()->get();
        $view = view(config('theme.member.view').'product.productSku.productSkuSupplier.md-create', compact('sku', 'suppliers'))->render();
        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
                'suppliers' => $suppliers
            ],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }




    public function edit(Request $request, Supplier $product_sku_supplier)
    {
        $data = $request->all();
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        $skuSupplier = $product_sku_supplier;
        $suppliers = $this->product_SKU_SupplierService->supplierRepo->builder()->get();

        $view = view(config('theme.member.view').'product.productSku.productSkuSupplier.md-edit',compact('sku', 'skuSupplier', 'suppliers'))->render();

        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
                'skuSupplier' => $skuSupplier,
                'suppliers' => $suppliers
            ],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }



    public function update(Product_SKU_SupplierRequest $request, Supplier $product_sku_supplier)
    {
        $data = $request->all();
        $skuSupplier = $product_sku_supplier;
        $TF = $this->product_SKU_SupplierService->update($skuSupplier, $data);
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
                'skuSupplier' => $skuSupplier,
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

    public function store(Product_SKU_SupplierRequest $request)
    {
        $data = $request->all();
        $TF = $this->product_SKU_SupplierService->store($data);
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        $skuSupplier = $this->product_SKU_SupplierService->supplierRepo->getById($data['s_id']);
        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
                'skuSupplier' => $skuSupplier,
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
