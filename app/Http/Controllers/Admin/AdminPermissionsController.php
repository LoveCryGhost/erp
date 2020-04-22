<?php

namespace App\Http\Controllers\Admin;


use App\Services\Admin\AdminPermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function config;
use function redirect;
use function view;

class AdminPermissionsController extends AdminCoreController
{

    public $adminPermissionService;
    public function __construct(AdminPermissionService $adminPermissionService)
    {
        $this->middleware('auth:admin');
        $this->adminPermissionService = $adminPermissionService;
    }

    //顯示Permission
    public function index()
    {
        $permissions = $this->adminPermissionService->adminPermissionRepo->builder()->get();
        return view(config('theme.admin.view').'permission.index',
            [
                'permissions' => $permissions
            ]);
    }

    public function edit(Permission $permission)
    {
       return view(config('theme.admin.view').'permission.edit',
           [
               'permission' => $permission
           ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->all();
        $this->adminPermissionService->update($permission, $data);
        return redirect()->route('admin.permission.index');
    }
}
