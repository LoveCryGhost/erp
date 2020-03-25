<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Models\SKUAttribute;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;

class Product_SKUService extends MemberCoreService implements MemberServiceInterface
{
    public $productRepo;
    public $typeRepo;
    public $skuRepo;

    public function __construct(ProductRepository $productRepository, SKURepository $skuRepository)
    {
        $this->productRepo = $productRepository;
        $this->skuRepo = $skuRepository;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {
        //儲存圖片
        $data = $this->save_thumbnail($data);

        //儲存一般資料
        $sku= $this->skuRepo->create($data);

        //處理SkuAttributes
        foreach ($data['sku_attributes'] as $attribute_id => $attribute_value){
            $skuAttribute = new SKUAttribute();
            $skuAttribute->a_id = $attribute_id;
            $skuAttribute->a_value = $attribute_value;
            $skuAttribute->sku_id =$sku->sku_id;
            $skuAttribute->save();
        }
        return $sku;
    }

    public function update($model, $data)
    {
        $sku= $model;
        $data = $this->save_thumbnail($data);

        $TF = $sku->update($data);

        //處理SkuAttributes
        foreach ($data['sku_attributes'] as $attribute_id => $attribute_value){
            $skuAttribute = SKUAttribute::where('sku_id',$sku->sku_id)->where('a_id', $attribute_id)->first();
            $skuAttribute->a_value = $attribute_value;
            $skuAttribute->save();
        }

    }

    public function destroy($model, $data)
    {
        // TODO: Implement destroy() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function save_thumbnail($data){
        //處理Thumbnail
        $uploader =new ImageUploadHandler();
        if(request()->thumbnail!="undefined" and request()->thumbnail) {
            $result = $uploader->save(request()->thumbnail, 'sku_thumbnails', '', 416);
            if ($result) {
                $data['thumbnail']=$result['path'];
            }
        }else{
            unset($data['thumbnail']);
        }

        return $data;
    }
}
