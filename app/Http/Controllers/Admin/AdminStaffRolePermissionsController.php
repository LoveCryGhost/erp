<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminMemberRequest;
use App\Models\Member;
use App\Services\Member\MemberService;
use App\Services\Staff\StaffService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function config;
use function dd;
use function view;

/**

 */
class AdminStaffRolePermissionsController extends AdminCoreController
{
    public $staffService;
    public function __construct(StaffService $staffService)
    {

        $this->middleware(['permission:admin.adminStaff.*|permission:admin.adminStaff.index'])->only('index');
        $this->staffService = $staffService;
    }

    public function index()
    {
        //所有Staff
        $staffs =$this->staffService->StaffRepo->builder()->with(['roles'])->paginate(10);
        return view(config('theme.admin.view').'.adminRolePermission.index',[
            'staffs' => $staffs
        ]);
    }
}
