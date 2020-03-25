<?php

namespace App\Http\Controllers\Staff;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Staff\StaffRequest;
use App\Models\Staff;

class StaffDashboardsController extends StaffCoreController
{

    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    //Dashboard
    public function dashboard(){
       dd('dashboard');
    }
}
