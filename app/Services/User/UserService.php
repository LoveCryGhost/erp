<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService extends UserCoreService
{
    protected $userRepo;

    public function __construct(UserRepository$userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function all(){

    }

    //儲存User照片
    public function save_avatar($data, $user, $request, $uploader){
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar']=$result['path'];
            }
        }
        return $data;
    }

    //儲存User照片
    public function save_change_password($data, $user, $request){
        $data['password'] = Hash::make($request->new_password);
        return $data;
    }
}
