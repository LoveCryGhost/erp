<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\Type;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypePolicy
{
    use HandlesAuthorization;

    /*
     * 两个参数，
     * 第一个参数默认为当前登录用户实例，
     * 第二个参数则为要进行授权的用户实例
     * */
    public function update(Member $member, Type $type)
    {
        return $member->isAuthorOf($type);
    }

    public function destroy(Member $member, Type $type)
    {
        return $member->isAuthorOf($type);
    }


}
