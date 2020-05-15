<?php

namespace App\Http\Controllers\Staff;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Staff\StaffRequest;
use App\Models\Staff;

class StaffDashboardsController extends StaffCoreController
{

    public function __construct()
    {
    }

    //Dashboard
    public function dashboard(){
        return view(config('theme.staff.view').'dashboard');
    }
}
