<?php

namespace App\Services\Member;

use App\Models\Product;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;
use App\Repositories\Member\TypeRepository;
use Illuminate\Support\Facades\Auth;
use function dd;

class SKUService extends MemberCoreService implements MemberServiceInterface
{
    public $productRepo;
    public $typeRepo;

    public function __construct(SKURepository $SKURepository)
    {
        $this->skuRepo = $SKURepository;
    }

    public function index()
    {
//        return $this->productRepo->builder()
//            ->where('member_id', Auth::guard('member')->user()->id)
//            ->with(['Type', 'ProductThumbnails', 'member'])->paginate(10);
    }
    
    public function store($data)
    {
//        return $this->productRepo->builder()->create($data);
    }

    public function update($model,$data)
    {
//        $product = $model;
//
//        //處理product_type, 若已經有sku, 則不能更改
//        if($product->all_skus->count()>0){
//            $data['t_id'] = $product->t_id;
//        }
//        return $product->update($data);
    }

    public function destroy($model, $data)
    {
//        $product = $model;
//        $product->delete();
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
