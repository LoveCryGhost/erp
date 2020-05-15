<?php

namespace App\Repositories\Admin;
use Spatie\Permission\Models\Permission;

class AdminPermissionRepository
{
    public function __construct(Permission $permission)
    {
        $this->adminPermissionRepo = $permission;
    }

    public function builder()
    {
        return $this->adminPermissionRepo;
    }

    public function getById($id)
    {
        return $this->adminPermissionRepo->find($id);
    }
}
