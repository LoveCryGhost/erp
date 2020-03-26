<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProductObserver extends Observer
{

    public function saving(Product $product)
    {
        if(request()->is_active == 1 or request()->is_active ==true or $product->is_active == 1){
            $product->is_active = 1;
        }else{
            $product->is_active = 0;
        }
        //判別是否為admin建立
        if(Auth::guard('member')->user()!=null) {
            $product->member_id = Auth::guard('member')->user()->id;
        }
    }

    public function creating(Product $product)
    {

    }

    public function created(Product $product)
    {
        $product->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.product'), $product->p_id);
        $product->save();
    }

    public function updating(Product $product)
    {
    }

    public function saved(Product $product)
    {

    }

    public function deleted( Product $product)
    {

    }
}


