<?php

namespace App\Http\Controllers\Admin;


use App\Services\Admin\AdminPermissionService;
use Spatie\Permission\Models\Permission;
use function config;
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
}
