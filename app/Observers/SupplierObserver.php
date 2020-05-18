<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;


class SupplierObserver extends Observer
{

    public function saving(Supplier $supplier)
    {
        if(request()->is_active == 1 or request()->is_active ==true){
            $supplier->is_active = 1;
        }else{
            $supplier->is_active = 0;
        }
        //判別是否為member建立
        if(Auth::guard('member')->user()!=null) {
            $supplier->member_id = Auth::guard('member')->user()->id;
        }else{
            $supplier->member_id=1;
        }
    }

    public function creating(Supplier $supplier)
    {

    }

    public function created(Supplier $supplier)
    {
        $supplier->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.supplier'), $supplier->s_id);
        $supplier->save();
    }

    public function updating(Supplier $supplier)
    {
    }

    public function saved(Supplier $supplier)
    {

    }

    public function deleted( Supplier $supplier)
    {

    }
}


