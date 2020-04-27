<?php

namespace App\Http\Controllers\Staff\MH\ExcelView;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Staff\StaffCoreController;
use App\Models\Shoes\ShoesMold;
use App\Models\Staff;
use function config;

class StaffExcelViewController extends StaffCoreController
{

    public function __construct()
    {
        $actions = [
            'costSPLabor'];
        $this->coreMiddleware('StaffExcelViewController', $guard='staff', $route="staffExcelView", $actions);
    }

    public function costSPLabor()
    {
        //讀取excel

        return view(config('theme.staff.view').'excelView.costSPLabor');
    }

}
