<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\ProductRequest;
use App\Models\Product;
use App\Repositories\Member\TypeRepository;
use App\Services\Member\ProductService;


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
        $products = $this->productService->index();
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

}
