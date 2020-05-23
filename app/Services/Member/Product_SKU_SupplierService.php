<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Request;
use App\Models\SKUAttribute;
use App\Models\SKUSupplier;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;
use App\Repositories\Member\SupplierRepository;
use function rand;

class Product_SKU_SupplierService extends MemberCoreService implements MemberServiceInterface
{
    public $productRepo;
    public $typeRepo;
    public $skuRepo;
    public $supplierRepo;

    public function __construct(SKURepository $skuRepository, SupplierRepository $supplierRepository)
    {
        $this->skuRepo = $skuRepository;
        $this->supplierRepo = $supplierRepository;
    }

    public function index()
    {

    }

    public function store($data)
    {
        $sku = $this->skuRepo->getById($data['sku_id']);

        if($data['is_active']=="true"){
            $data['is_active']=1;
        }else{
            $data['is_active']=0;
        }
        $a = $sku->skuSuppliers()->attach([
            "" => [
                'is_active' => $data['is_active'],
                'sku_id' => $data['sku_id'],
                's_id' => $data['s_id'],
                'price' => $data['price'],
                'url' => $data['url'],
                'random' => rand(1,999999999999999)
            ]
        ]);

        $skuSupplier = SKUSupplier::latest()->first();
        $sku->skuSuppliers()->updateExistingPivot(
            $skuSupplier , [
            'is_active' => $data['is_active'],
            'sku_id' => $data['sku_id'],
            's_id' => $data['s_id'],
            'price' => $data['price'],
            'url' => $data['url'],
            'random' => rand(1,999999999999999)
        ]);

        return  [];
    }

    public function update($model, $data)
    {
        $skuSupplier= $model;
        $sku = $this->skuRepo->getById($data['sku_id']);
        if($data['is_active']=="true"){
            $data['is_active']=1;
        }else{
            $data['is_active']=0;
        }
        return  $sku->skuSuppliers()->updateExistingPivot(
            $skuSupplier->s_id , [
                    'is_active' => $data['is_active'],
                    'sku_id' => $data['sku_id'],
                    's_id' => $data['s_id'],
                    'price' => $data['price'],
                    'url' => $data['url'],
                    'random' => rand(1,999999999999999)
                ]);
    }

    public function destroy($model, $data)
    {
        // TODO: Implement destroy() method.
    }

    public function create()
    {

    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function save_thumbnail($data){
//        //處理Thumbnail
//        $uploader =new ImageUploadHandler();
//        if(request()->thumbnail!="undefined" and request()->thumbnail) {
//            $result = $uploader->save(request()->thumbnail, 'sku_thumbnails', '', 416);
//            if ($result) {
//                $data['thumbnail']=$result['path'];
//            }
//        }else{
//            unset($data['thumbnail']);
//        }
//
//        return $data;
    }
}
