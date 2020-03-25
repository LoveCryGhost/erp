<?php

namespace App\Http\Controllers\Staff;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Staff\StaffRequest;
use App\Models\Staff;
use App\Rules\CurrentPasswordRule;
use App\Services\Staff\StaffService;
use Illuminate\Http\Request;

class StaffsController extends StaffCoreController
{

    private $staffService;
    public function __construct(StaffService $staffService)
    {
        $this->middleware('auth:staff');
        $this->staffService = $staffService;

    }

    public function list()
    {
        $staffs = $this->staffService->StaffRepo->builder()->paginate(10);
        return view(config('theme.staff.view').'staff.list', [
            'staffs' => $staffs,
            'filters' => [
            ]
        ]);
    }

    public function index(){
        return view(config('theme.staff.view').'staff.index');
    }

    //顯示使用者資料
    public function edit(Staff $staff)
    {
        $this->authorize('update', $staff);
        $staffs = $this->staffService->StaffRepo->builder()->get();
        return view(config('theme.staff.view').'staff.edit', compact('staff', 'staffs'));
    }

    //顯示使用者資料
    public function create(Staff $staff)
    {
        return view(config('theme.staff.view').'staff.create');
    }

    //顯示使用者資料
    public function store(StaffRequest $request, Staff $staff)
    {
        $data = $request->all();
        $toast = $this->staffService->store($data);
        return redirect()->route('staff.staff.staff_list')->with('toast', parent::$toast_store);
    }

    public function update(StaffRequest $request,  ImageUploadHandler $uploader,Staff $staff)
    {
        $this->authorize('update', $staff);
        $data = $request->all();
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'staff/avatars', $staff->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        if($request->photo_id1) {
            $result = $uploader->save($request->photo_id1, 'staff/photo_id', $staff->id, 416);
            if ($result) {
                $data['photo_id1'] = $result['path'];
            }
        }

        if($request->photo_id2) {
            $result = $uploader->save($request->photo_id2, 'staff/photo_id', $staff->id, 416);
            if ($result) {
                $data['photo_id2'] = $result['path'];
            }
        }

        if($request->medical_check) {
            $result = $uploader->save($request->medical_check, 'staff/medical_check', $staff->id, 416);
            if ($result) {
                $data['medical_check'] = $result['path'];
            }
        }


        $staff->update($data);
        return redirect()->route('staff.staff.edit',['staff' => $staff->id])
            ->with('toast', [
                "heading" => "個人訊息 - 更新成功",
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
        $this->authorize('update', $staff);
        //驗證
        $this->validate(request(), [
            'old_password' => ['required', new CurrentPasswordRule()],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'old_password.required' => '舊密碼不能為空',
            'old_password.same' => '舊密碼輸入錯誤',
            'new_password.required' => '新密碼不能為空 且 最少為8位數字',
            'new_password.min' => '新密碼不能為空 且 最少為8位數字',
            'new_password.confirmed' => '密碼必須一致',
        ]);

        $data = $request->all();
        $toast = $this->staffService->update_password($staff, $data);
        return redirect()->route('staff.staff.edit', ['staff'=> $staff->id])
            ->with('toast', [
                "heading" => "您的密碼已經更新成功",
                "text" =>  '請於下次登入時使用新密碼!',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }


}
