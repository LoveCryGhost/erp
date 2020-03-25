<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Supplier;
use App\Models\SupplierContact;
use Illuminate\Support\Facades\Auth;


class SupplierContactObserver extends Observer
{

    public function saving(SupplierContact $supplierContact)
    {

        //判別是否為member建立
        if(Auth::guard('member')->user()!=null) {
            $supplierContact->member_id = Auth::guard('member')->user()->id;
        }else{
            $supplierContact->member_id=1;
        }
    }

    public function creating(SupplierContact $supplierContact)
    {

    }

    public function created(SupplierContact $supplierContact)
    {
//        $supplierContact->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.supplierContact'), $supplierContact->sc_id);
        $supplierContact->save();
    }

    public function updating(SupplierContact $supplierContact)
    {
    }

    public function saved(SupplierContact $supplierContact)
    {

    }

    public function deleted( SupplierContact $supplierContact)
    {

    }
}


