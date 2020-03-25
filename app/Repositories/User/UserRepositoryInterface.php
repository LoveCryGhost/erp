<?php

namespace App\Repositories\User;



interface UserRepositoryInterface{

    public function all($row_qty);

    public function save_avatar();
}
