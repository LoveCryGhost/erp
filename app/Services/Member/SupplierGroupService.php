<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Repositories\Member\SupplierGroupRepository;

class SupplierGroupService extends MemberCoreService implements MemberServiceInterface
{
    public $supplierGroupRepo;
    public $attributeRepo;

    public function __construct(SupplierGroupRepository $supplierGroupRepository)
    {
        $this->supplierGroupRepo = $supplierGroupRepository;
    }

    public function index()
    {
        return $this->supplierGroupRepo->builder()->with(['member'])->paginate(10);
    }

    public function create()
    {
//        return $this->get();
    }



    public function edit()
    {

    }

    public function store($data)
    {
        return $this->supplierGroupRepo->builder()->create($data);
    }

    public function update($model, $data)
    {
        $supplierGroup = $model;
        //處理 name_card
        $data = $this->save_name_card($data);
        return $supplierGroup->update($data);
    }

    public function save_name_card($data)
    {
        $uploader =new ImageUploadHandler();
        if(request()->name_card and request()->name_card!="undefined") {
            $result = $uploader->save(request()->name_card, 'supplier_groups','', 416);
            if ($result) {
                $data['name_card']=$result['path'];
            }
        }else{
            unset($data['name_card']);
        }
        return $data;
    }
    public function destroy($model, $data)
    {
        $supplierGroup = $model;
        return $supplierGroup->delete();
    }


}
