<?php

namespace App\Policies;

use App\Models\Staff;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
{
    use HandlesAuthorization;

    /*
     * 两个参数，
     * 第一个参数默认为当前登录用户实例，
     * 第二个参数则为要进行授权的用户实例
     * */
    public function update(Staff $currentStaff, Staff $staff)
    {
        return $currentStaff->id === $staff->id;
    }
}
