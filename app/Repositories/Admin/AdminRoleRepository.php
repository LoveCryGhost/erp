<?php

namespace App\Repositories\Admin;

use Spatie\Permission\Models\Role;

class AdminRoleRepository extends AdminCoreRepository
{
    public function __construct(Role $role)
    {
        $this->adminRoleRepo = $role;
    }

    public function builder()
    {
        return $this->adminRoleRepo;
    }

    public function getById($id)
    {
        return $this->adminRoleRepo->find($id);
    }


}
