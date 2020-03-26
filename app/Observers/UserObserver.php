<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserObserver extends Observer
{

    public function saving(User $user)
    {
        if(request()->is_active == 1 or request()->is_active ==true or $user->is_active == 1){
            $user->is_active = 1;
        }else{
            $user->is_active = 0;
        }
    }

    public function creating(User $user)
    {
        //判別是否為member建立
        if(Auth::guard('member')->user()){
            $user->member_id = Auth::guard('member')->user()->id;
        }
    }

    public function created(User $user)
    {
        $user->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.user'), $user->id);
        $user->save();
    }

    public function updating(User $user)
    {
    }

    public function saved(User $user)
    {

    }

    public function deleted( User $user)
    {

    }
}


