<?php

namespace App\Http\Controllers\Admin;


use App\Services\Admin\AdminRoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use function config;
use function redirect;
use function view;

class AdminRolesController extends AdminCoreController
{

    public $adminRoleService;
    public function __construct(AdminRoleService $adminRoleService)
    {
        $this->middleware('auth:admin');
        $this->adminRoleService = $adminRoleService;
    }

    //顯示Role
    public function index()
    {
        $roles = $this->adminRoleService->adminRoleRepo->builder()->get();
        return view(config('theme.admin.view').'role.index',
            [
                'roles' => $roles
            ]);
    }

    public function edit(Role $role)
    {
       return view(config('theme.admin.view').'role.edit',
           [
               'role' => $role
           ]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->all();
        $this->adminRoleService->update($role, $data);
        return redirect()->route('admin.role.index');
    }
}
