<?php

namespace App\Services\Admin;


use App\Repositories\Admin\AdminPermissionRepository;
use App\Services\Admin\AdminServiceInterface;
use App\Services\Service;

class AdminPermissionService extends Service  implements AdminServiceInterface
{
    public $adminPermissionRepo;
    public function __construct(AdminPermissionRepository $adminPermissionRepository)
    {
        $this->adminPermissionRepo = $adminPermissionRepository;
    }

    public function index()
    {
    }

    public function create()
    {
    }

    public function edit()
    {

    }

    public function store($data)
    {

    }

    public function update($model,$data)
    {
        $permission = $model;
        return $permission->update($data);
    }


    public function destroy($model, $data)
    {

    }
}
