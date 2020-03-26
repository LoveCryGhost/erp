<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Repositories\Member\SupplierContactRepository;
use App\Repositories\Member\SupplierRepository;
use Illuminate\Support\Facades\Auth;

class SupplierService extends MemberCoreService implements MemberServiceInterface
{
    public $supplierRepo;
    public $attributeRepo;
    private $supplierContactRepository;

    public function __construct(SupplierRepository $supplierRepository, SupplierContactRepository $supplierContactRepository)
    {
        $this->supplierRepo = $supplierRepository;
        $this->supplierContactRepository = $supplierContactRepository;
    }

    public function index()
    {
        return $this->supplierRepo->builder()->with(['member'])->paginate(10);
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
        $data = $this->save_name_card($data);
        return $this->supplierRepo->builder()->create($data);
    }

    public function update($model, $data)
    {
        $supplier = $model;
        //處理name_card
        $data = $this->save_name_card($data);

        //處理大量 SupplierContact 順序
        $SupplierContactModel = $this->supplierContactRepository->builder();
        $rows = [];
        foreach ($data['supplier_contacts']['ids'] as $sort_order => $supplier_contacts){
            $rows[] =  [
                'sc_id' => $data['supplier_contacts']['ids'][$sort_order],
                's_id' => $supplier->s_id,
                'sort_order' => $sort_order,
                'sc_name' => $data['supplier_contacts']['sc_name'][$sort_order],
                'member_id' => Auth::guard('member')->user()->id,
            ];
        }
        $TF = $this->supplierContactRepository->massUpdate($SupplierContactModel,$rows);
        unset($data['supplier_contacts']);
        return $supplier->update($data);
    }

    public function save_name_card($data)
    {
        $uploader =new ImageUploadHandler();
        if(request()->name_card and request()->name_card!="undefined") {
            $result = $uploader->save(request()->name_card, 'suppliers', '', 416);
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
        $supplier = $model;
        return $supplier->delete();
    }


}
