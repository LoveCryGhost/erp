<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;

class AdminMonitorsController extends AdminCoreController
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function crawler_monitor()
    {
        dd(12);
    }
}
