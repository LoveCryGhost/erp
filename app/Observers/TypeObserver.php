<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;


class TypeObserver extends Observer
{

    public function saving(Type $type)
    {
        if(request()->is_active == 1 or request()->is_active ==true or  $type->is_active == 1){
            $type->is_active = 1;
        }else{
            $type->is_active = 0;
        }
        //判別是否為admin建立
        if(Auth::guard('member')->user()!=null) {
            $type->member_id = Auth::guard('member')->user()->id;
        }
    }

    public function creating(Type $type)
    {

    }

    public function created(Type $type)
    {
        $type->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.type'), $type->t_id);
        $type->save();
    }

    public function updating(Type $type)
    {
    }

    public function saved(Type $type)
    {

    }

    public function deleted( Type $type)
    {

    }
}


