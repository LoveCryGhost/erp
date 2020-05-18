<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;


class AttributeObserver extends Observer
{

    public function saving(Attribute $attribute)
    {
        if(request()->is_active == 1 or request()->is_active ==true){
            $attribute->is_active = 1;
        }else{
            $attribute->is_active = 0;
        }
        //判別是否為member建立
        if(Auth::guard('member')->user()!=null) {
            $attribute->member_id = Auth::guard('member')->user()->id;
        }
    }

    public function creating(Attribute $attribute)
    {

    }

    public function created(Attribute $attribute)
    {
        $attribute->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.attribute'), $attribute->a_id);
        $attribute->save();
    }

    public function updating(Attribute $attribute)
    {
    }

    public function saved(Attribute $attribute)
    {

    }

    public function deleted( Attribute $attribute)
    {

    }
}


