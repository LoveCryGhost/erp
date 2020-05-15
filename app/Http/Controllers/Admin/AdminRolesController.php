<?php

namespace App\Http\Controllers\Admin;


use App\Models\CrawlerItem;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Member\MemberCoreRepository;
use App\Services\Admin\AdminRoleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function compact;
use function config;
use function dd;
use function explode;
use function json_decode;
use function redirect;
use function request;
use function strpos;
use function view;

class AdminRolesController extends AdminCoreController
{

    public $adminRoleService;
    public function __construct(AdminRoleService $adminRoleService)
    {
        $actions = [
            '*',
            'index',
            'show', 'edit','update',
            'create', 'store',
            'destroy',
            'show',
            'assignPermissionToRole','update_nestable_order'];
        $this->coreMiddleware('AdminRolesController', $guard='admin', $route="adminRole", $actions);

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
        $permissions = Permission::where('guard_name', $role->guard_name)->where('p_id',0)->orderBy('sort_order','ASC')->get();
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

        //移除
        if($role->hasPermissionTo($permission->name)){
            //是否有萬用字元, 乳果有萬用字元，就將相關權限都移除
            if(false !== ($rst = strpos($permission->name, ".*"))){
                $_route = explode('.*',$permission->name);
                $permissions = Permission::where('guard_name', $role->guard_name)->where('name','LIKE','%'.$_route[0].'.%')->get();
                $role->revokePermissionTo($permissions);
            }else{
                $permission->removeRole($role);
            }
        //新增
        }else{
            //是否有萬用字元, 乳果有萬用字元，就將相關權限都移除
            if(false !== ($rst = strpos($permission->name, ".*"))){
                $_route = explode('.*',$permission->name);
                $permissions = Permission::where('guard_name', $role->guard_name)->where('name','LIKE','%'.$_route[0].'.%')->get();
                $role->givePermissionTo($permissions);
            }else{
                $permission->assignRole($role);
            }
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

    public function update_nestable_order(Request $request)
    {
        $data = $request->all();
        $nestable_output =  $data['nestable_output'];

        $permissions = json_decode($nestable_output);
        $row_item = [];

        $row_item =  $this->nestable_parent($row_item,$p_id=0, $permissions);
        //Update CrawlerItem
        $permission = new Permission();
        $TF = $this->adminRoleService->adminRoleRepo->massUpdate($permission, $row_item);

    }

    public function nestable_parent($row_item, $p_id, $permissions)
    {
        $index=1;
        foreach ($permissions as $permission){
            //是否有Children
            if(!isset($permission->children)){
                $row_item[]=[
                    'id' => $permission->id,
                    'p_id' => $p_id,
                    'sort_order' => $index,
                ];

            }else{
                $row_item[]=[
                    'id' => $permission->id,
                    'p_id' => $p_id,
                    'sort_order' => $index,
                ];
                $row_item = $this->nestable_children($row_item, $permission->id, $permissions=$permission->children);
            }
            $index++;
        }

        return $row_item;
    }

    public function nestable_children($row_item,$p_id, $permissions)
    {
        $index=1;
        foreach ($permissions as $permission){

            //是否有Children
            if(!isset($permission->children)>0){
                $row_item[]=[
                    'id' => $permission->id,
                    'p_id' => $p_id,
                    'sort_order' => $index,
                ];
            }else{
                $row_item[]=[
                    'id' => $permission->id,
                    'p_id' => $p_id,
                    'sort_order' => $index,
                ];
                $row_item = $this->nestable_children($row_item, $permission->id, $permissions=$permission->children);
            }

            $index++;
        }

        return $row_item;
    }
}
