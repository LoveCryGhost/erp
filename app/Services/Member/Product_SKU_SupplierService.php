<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Request;
use App\Models\SKUAttribute;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;
use App\Repositories\Member\SupplierRepository;

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
        return  $sku->skuSuppliers()->attach([
            "" => [
                'sku_id' => $data['sku_id'],
                's_id' => $data['s_id'],
                'price' => $data['price'],
                'url' => $data['url']
            ]
        ]);
    }

    public function update($model, $data)
    {
        $skuSupplier= $model;
        $sku = $this->skuRepo->getById($data['sku_id']);
        //$skuSupplierPivot = $sku->skuSuppliers()->wherePivot('s_id',$skuSupplier->s_id)->first();
        return  $sku->skuSuppliers()->updateExistingPivot(
            $skuSupplier->s_id , [
                    'sku_id' => $data['sku_id'],
                    's_id' => $data['s_id'],
                    'price' => $data['price'],
                    'url' => $data['url']
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
