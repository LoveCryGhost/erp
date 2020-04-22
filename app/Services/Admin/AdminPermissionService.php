<?php

namespace App\Services\Admin;


use App\Repositories\Admin\AdminPermissionRepository;
use App\Services\Service;

class AdminPermissionService extends Service
{
    public $adminPermissionRepo;
    public function __construct(AdminPermissionRepository $adminPermissionRepository)
    {
        $this->adminPermissionRepo = $adminPermissionRepository;
    }
}
