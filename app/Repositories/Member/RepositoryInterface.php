<?php

namespace App\Repositories\Member;


use Illuminate\Database\Eloquent\Model;

Interface RepositoryInterface
{

    public function builder();
    public function getById($id);


}
