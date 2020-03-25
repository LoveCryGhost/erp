<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminMemberRequest;
use App\Models\Member;
use App\Services\Member\MemberService;
use Illuminate\Http\Request;

/**

 */
class AdminMembersController extends AdminCoreController
{

    protected $memberService;
    public function __construct(MemberService $memberService)
    {
        $this->middleware('auth:admin');
        $this->memberService = $memberService;
    }

    //Dashboard
    public function index(){
        $members = Member::withCount(['memberLogs'])->paginate(10);
        return view(config('theme.admin.view').'member.index', compact('members'));
    }

    public function edit(Member $member){
        return view(config('theme.admin.view').'member.edit', compact('member'));
    }

    public function update(AdminMemberRequest $request , ImageUploadHandler $uploader, Member $member)
    {
        $data = $request->all();

        $data = $this->memberService->save_avatar($data, $member,$request, $uploader);

        $member->update($data);
        return redirect()->route('admin.member.index')
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
    public function update_password(Request $request, Member $member)
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
        $data = $this->memberService->save_change_password($data, $member,$request);

        $member->update($data);
        return redirect()->route('admin.member.edit', ['member'=> $member->id])
            ->with('toast', [
                "heading" => "Member 密碼 - 更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }


    public function create(){
        return view(config('theme.admin.view').'member.create');
    }


}
