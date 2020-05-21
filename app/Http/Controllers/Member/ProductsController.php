<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\ProductRequest;
use App\Models\Product;
use App\Repositories\Member\TypeRepository;
use App\Services\Member\ProductService;
use function app;
use function request;


class ProductsController extends MemberCoreController
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:member');
        $this->productService = $productService;
    }

    public function create()
    {
        $types = $this->productService->typeRepo->builder()->all();
        return view(config('theme.member.view').'product.create', compact('types'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $toast = $this->productService->store($data);
        return redirect()->route('member.product.index')->with('toast', parent::$toast_store);
    }

    public function index()
    {
        $query = $this->productService->productRepo->builder();
        $this->filters = [
            'p_name' => request()->p_name,
            'id_code' => request()->id_code,
            'sku_name' => request()->sku_name
        ];
        $query = $this->index_filters($query, $this->filters);
        $products = $query->with(['type','productThumbnails','member'])->paginate(10);
        return view(config('theme.member.view').'product.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $types = $this->productService->typeRepo->builder()->all();
        return view(config('theme.member.view').'product.edit', compact('product','types'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $data = $request->all();
        $toast = $this->productService->update($product, $data);
        return redirect()->route('member.product.index')->with('toast',  parent::$toast_update);
    }


    public function destroy(Product $product)
    {
        $this->authorize('destroy', $product);
        $toast = $this->productService->destroy($product);
        return redirect()->route('member.product.index')->with('toast',  parent::$toast_destroy);
    }

    public function index_filters($query, $filters)
    {
        $query  = $this->filter_like($query,'p_name', $filters['p_name']);
        $query  = $this->filter_like($query,'id_code', $filters['id_code']);
        if(!empty($filters['sku_name'])){
            $query = $query->whereHas('all_skus', function ($q) use($filters) {
                $q->whereTranslationLike('sku_name', '%'.$filters['sku_name'].'%', app()->getLocale());
            });
        }
        return $query;
    }

}
