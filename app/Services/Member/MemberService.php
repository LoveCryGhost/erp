<?php

namespace App\Services\Member;

use App\Repositories\Member\MemberRepository;
use App\Rules\CurrentPasswordRule;
use Illuminate\Support\Facades\Hash;

class MemberService extends MemberCoreService implements MemberServiceInterface
{
    protected $memberRepo;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepo = $memberRepository;
    }


    //儲存Member照片
    public function save_avatar($data, $member, $request, $uploader){
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $member->id, 416);
            if ($result) {
                $data['avatar']=$result['path'];
            }
        }
        return $data;
    }

    //儲存Member照片
    public function save_change_password($data, $member, $request){
        $data['password'] = Hash::make($request->new_password);
        return $data;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function set_avatar($member, $data, $uploader){
        if(request()->avatar) {
            $result = $uploader->save(request()->avatar, 'avatars', $member->id, 416);
            if ($result) {
                $data['avatar']=$result['path'];
            }
        }
        return $data;
    }

    public function update($model, $data)
    {
        $member = $model;
        return $member->update($data);
    }

    public function destroy($model, $data)
    {
        // TODO: Implement destroy() method.
    }


    public function update_password($member, $data)
    {
        $data['password'] = Hash::make(request()->new_password);
        return $member->update($data);
    }


    public function create()
    {
        // TODO: Implement create() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }
}
