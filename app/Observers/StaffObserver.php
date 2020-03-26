<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class StaffObserver extends Observer
{

    public function saving(Staff $staff)
    {
        if(request()->is_active == 1 or request()->is_active ==true or $staff->is_active == 1){
            $staff->is_active = 1;
        }else{
            $staff->is_active = 0;
        }
        if(request()->is_block == 1 or request()->is_block ==true){
            $staff->is_block = 1;
        }else{
            $staff->is_block = 0;
        }

        if(request()->d_id == null){
            $staff->d_id = 1;
        }
    }

    public function creating(Staff $staff)
    {
        $staff->password = Hash::make('1234567890');
        $staff->email = 'a'.rand(100000,9999999999).'@app.cp,';
    }

    public function created(Staff $staff)
    {
        $staff->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.staff'), $staff->id);
        $staff->email = $staff->id.'.'.$staff->email;
        $staff->save();
    }

    public function updating(Staff $staff)
    {
    }

    public function saved(Staff $staff)
    {

    }

    public function deleted( Staff $staff)
    {

    }
}


