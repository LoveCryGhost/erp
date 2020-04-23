<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminMemberRequest;
use App\Models\Member;
use App\Services\Member\MemberService;
use App\Services\Staff\StaffService;
use Illuminate\Http\Request;
use function config;
use function view;

/**

 */
class AdminStaffAssignRolePermissionsController extends AdminCoreController
{
    public $staffService;
    public function __construct(StaffService $staffService)
    {
        $this->middleware('auth:admin');
        $this->staffService = $staffService;
    }

    public function index()
    {
        //所有Staff
        $staffs =$this->staffService->StaffRepo->builder()->with(['roles'])->paginate(10);
        return view(config('theme.admin.view').'.assignRolePermission.index',[
            'staffs' => $staffs
        ]);
    }
}
