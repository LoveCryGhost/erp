<?php

namespace App\Policies;

use App\Models\Attribute;
use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttributePolicy
{
    use HandlesAuthorization;

    /*
     * 两个参数，
     * 第一个参数默认为当前登录用户实例，
     * 第二个参数则为要进行授权的用户实例
     * */
    public function update(Member $member, Attribute $attribute)
    {
        return $member->isAuthorOf($attribute);
    }

    public function destroy(Member $member, Attribute $attribute)
    {
        return $member->isAuthorOf($attribute);
    }


}
