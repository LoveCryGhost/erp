<?php

namespace App\Http\Controllers\Admin;


use App\Services\Admin\AdminRoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function compact;
use function config;
use function redirect;
use function request;
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

    public function edit(Role $adminRole)
    {
        $role = $adminRole;
       return view(config('theme.admin.view').'role.edit',
           [
               'role' => $role
           ]);
    }

    public function update(Request $request, Role $adminRole)
    {
        $role = $adminRole;
        $data = $request->all();
        $this->adminRoleService->update($role, $data);
        return redirect()->route('admin.adminRole.index');
    }

    public function showAllPermission(Request $request)
    {
        $data = $request->all();

        $role = Role::with(['permissions'])->find($data['role_id']);
        $permissions = Permission::where('guard_name', $role->guard_name)->get();
        $view = view(config('theme.admin.view').'role.showAllPermission',[
            'data' => $data, 'role' => $role,
            'permissions' => $permissions
        ])->render();
        return [
            'errors' => '',
            'models'=> [
                'role' => $role,
            ],
            'request' => request()->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

    public function assignPermissionToRole(Request $request)
    {
        $data = $request->all();
        $role = Role::find($data['role_id']);
        $permission = Permission::find($data['permission_id']);

        if($role->hasPermissionTo($permission->name)){
            //移除
            $permission->removeRole($role);
        }else{
            //新增
            $permission->assignRole($role);
        }



        return [
            'errors' => '',
            'models'=> [
            ],
            'request' => request()->all(),
            'view' => "",
            'options'=>[]
        ];
    }
}
