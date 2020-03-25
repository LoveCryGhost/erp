<?php

namespace App\Services\Staff;

use App\Repositories\Staff\StaffRepository;
use App\Rules\CurrentPasswordRule;
use Illuminate\Support\Facades\Hash;

class StaffService extends StaffCoreService implements StaffServiceInterface
{
    public $StaffRepo;

    public function __construct(StaffRepository $StaffRepository)
    {
        $this->StaffRepo = $StaffRepository;
    }


    //儲存Staff照片
    public function save_avatar($data, $Staff, $request, $uploader){
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $Staff->id, 416);
            if ($result) {
                $data['avatar']=$result['path'];
            }
        }
        return $data;
    }

    //儲存Staff照片
    public function save_change_password($data, $Staff, $request){
        $data['password'] = Hash::make($request->new_password);
        return $data;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {
        return $this->StaffRepo->builder()->create($data);
    }

    public function set_avatar($Staff, $data, $uploader){
        if(request()->avatar) {
            $result = $uploader->save(request()->avatar, 'avatars', $Staff->id, 416);
            if ($result) {
                $data['avatar']=$result['path'];
            }
        }
        return $data;
    }

    public function update($model, $data)
    {
        $Staff = $model;
        return $Staff->update($data);
    }

    public function destroy($model, $data)
    {

    }


    public function update_password($Staff, $data)
    {
        $data['password'] = Hash::make(request()->new_password);
        return $Staff->update($data);
    }


    public function create()
    {

    }

    public function edit()
    {

    }
}
