<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\ProductRequest;
use App\Models\Product;
use App\Repositories\Member\TypeRepository;
use App\Services\Member\ProductService;
use function app;
use function request;


class SKUController extends MemberCoreController
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
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
        $products = $query->with(['type','all_skus', 'productThumbnails'])->paginate(10);
        return view(config('theme.member.view').'sku.index', compact('products'));
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
