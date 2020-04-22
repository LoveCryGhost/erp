<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Staff;
use App\Models\StaffExcelLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function request;


class StaffExcelLikeObserver extends Observer
{

    public function saving(StaffExcelLike $staffExcelLike)
    {
        if(request()->is_active == 1 or request()->is_active ==true or $staffExcelLike->is_active == 1){
            $staffExcelLike->is_active = 1;
        }else{
            $staffExcelLike->is_active = 0;
        }
        
        if(request()->showable == 1 or request()->showable ==true){
            $staffExcelLike->showable = 1;
        }else{
            $staffExcelLike->showable = 0;
        }

        if(request()->editable == 1 or request()->editable ==true){
            $staffExcelLike->editable = 1;
        }else{
            $staffExcelLike->editable = 0;
        }
    }

    public function creating(StaffExcelLike $staffExcelLike)
    {

    }

    public function created(StaffExcelLike $staffExcelLike)
    {

        $staffExcelLike->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.staff_excel'), $staffExcelLike->id);

        $staffExcelLike->save();
    }

    public function updating(StaffExcelLike $staffExcelLike)
    {
    }

    public function saved(StaffExcelLike $staffExcelLike)
    {
        $file_name = 'public/excellike/'.$staffExcelLike->id_code.'.js';
        if(!empty(request()->jquery)){
            Storage::put($file_name, request()->jquery);
        }else{
            Storage::delete($file_name);
        }
    }

    public function deleted( Staff $staffExcelLike)
    {

    }
}


