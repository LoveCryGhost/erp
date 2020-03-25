<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminStaffRequest;
use App\Models\Staff;
use App\Services\Staff\StaffService;
use Illuminate\Http\Request;

/**

 */
class AdminStaffsController extends AdminCoreController
{

    protected $staffService;
    public function __construct(StaffService $staffService)
    {
        $this->middleware('auth:admin');
        $this->staffService = $staffService;
    }

    //Dashboard
    public function index(){
        $staffs = Staff::withCount(['staffLogs'])->paginate(10);
        return view(config('theme.admin.view').'staff.index', compact('staffs'));
    }

    public function edit(Staff $staff){
        $staffs = $this->staffService->StaffRepo->builder()->get();
        return view(config('theme.admin.view').'staff.edit', compact('staff', 'staffs'));
    }

    public function update(AdminStaffRequest $request , ImageUploadHandler $uploader, Staff $staff)
    {
        $data = $request->all();

        $data = $this->staffService->save_avatar($data, $staff,$request, $uploader);

        $staff->update($data);
        return redirect()->route('admin.staff.edit',['staff'=>$staff->id])
            ->with('toast', [
                "heading" => "員工訊息 - 更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }

    //更新密碼
    public function update_password(Request $request, Staff $staff)
    {
        //驗證
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'new_password.required' => '新密碼不能為空 且 最少為8位數字',
            'new_password.min' => '新密碼不能為空 且 最少為8位數字',
            'new_password.confirmed' => '密碼必須一致',
        ]);

        $data = $request->all();
        $data = $this->staffService->save_change_password($data, $staff,$request);

        $staff->update($data);
        return redirect()->route('admin.staff.edit', ['staff'=> $staff->id])
            ->with('toast', [
                "heading" => "Staff 密碼 - 更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }


    public function create(){
        return view(config('theme.admin.view').'staff.create');
    }
}
