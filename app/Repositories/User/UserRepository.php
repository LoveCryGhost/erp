<?php

namespace App\Repositories\User;


use App\Models\User;

class UserRepository implements UserRepositoryInterface
{


//  取出User數量
    public function all($row_qty)
    {
        return User::paginate($row_qty);
    }

//    儲存相片
    public function save_avatar(){
        return 'test in Repo';
    }
}
