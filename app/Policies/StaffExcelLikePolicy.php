<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\StaffExcelLike;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffExcelLikePolicy
{
    use HandlesAuthorization;

    /*
     * 两个参数，
     * 第一个参数默认为当前登录用户实例，
     * 第二个参数则为要进行授权的用户实例
     * */
    public function update(Staff $currentStaff, StaffExcelLike $staffExcelLike)
    {
        return $currentStaff->id === $staffExcelLike->pic;
    }
}
