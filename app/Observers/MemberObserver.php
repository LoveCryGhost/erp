<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;


class MemberObserver extends Observer
{

    public function saving(Member $member)
    {
        if(request()->is_active == 1 or request()->is_active ==true or $member->is_active == 1){
            $member->is_active = 1;
        }else{
            $member->is_active = 0;
        }
    }

    public function creating(Member $member)
    {
        //判別是否為admin建立
        if(Auth::guard('admin')->check){
            $member->admin_id = Auth::guard('admin')->user()->id;
        }
    }

    public function created(Member $member)
    {
        $member->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.admin'), $member->id);
        $member->save();
    }

    public function updating(Member $member)
    {
    }

    public function saved(Member $member)
    {

    }

    public function deleted( Member $member)
    {

    }
}


