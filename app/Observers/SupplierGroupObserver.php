<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\SupplierGroup;
use Illuminate\Support\Facades\Auth;


class SupplierGroupObserver extends Observer
{

    public function saving(SupplierGroup $supplierGroup)
    {
        if(request()->is_active == 1 or request()->is_active ==true or $supplierGroup->is_active == 1){
            $supplierGroup->is_active = 1;
        }else{
            $supplierGroup->is_active = 0;
        }

        //判別是否為member建立
        if(Auth::guard('member')->user()!=null) {
            $supplierGroup->member_id = Auth::guard('member')->user()->id;
        }else{
            $supplierGroup->member_id=1;
        }
    }

    public function creating(SupplierGroup $supplierGroup)
    {

    }

    public function created(SupplierGroup $supplierGroup)
    {
        $supplierGroup->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.supplierGroup'), $supplierGroup->sg_id);
        $supplierGroup->save();
    }

    public function updating(SupplierGroup $supplierGroup)
    {
    }

    public function saved(SupplierGroup $supplierGroup)
    {

    }

    public function deleted( SupplierGroup $supplierGroup)
    {

    }
}


