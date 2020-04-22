<?php

namespace App\Services\Admin;


use App\Repositories\Admin\AdminRoleRepository;
use App\Services\Admin\AdminServiceInterface;
use App\Services\Service;

class AdminRoleService extends Service implements AdminServiceInterface
{
    public $adminRoleRepo;
    public function __construct(AdminRoleRepository $adminRoleRepository)
    {
        $this->adminRoleRepo = $adminRoleRepository;
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
        $role = $model;
        return $role->update($data);
    }


    public function destroy($model, $data)
    {

    }

}
