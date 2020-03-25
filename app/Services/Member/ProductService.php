<?php

namespace App\Services\Member;

use App\Models\Product;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\TypeRepository;
use Illuminate\Support\Facades\Auth;

class ProductService extends MemberCoreService implements MemberServiceInterface
{
    public $productRepo;
    public $typeRepo;

    public function __construct(ProductRepository $productRepository,  TypeRepository $typeRepository)
    {
        $this->productRepo = $productRepository;
        $this->typeRepo = $typeRepository;
    }

    public function index()
    {
        return $this->productRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)
            ->with(['Type', 'ProductThumbnails', 'member'])->paginate(10);
    }


    public function store($data)
    {
        return $this->productRepo->builder()->create($data);
    }

    public function update($model,$data)
    {
        $product = $model;
        return $product->update($data);
    }

    public function destroy($model, $data)
    {
        $product = $model;
        $product->delete();
    }


    public function create()
    {
        // TODO: Implement create() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }
}
