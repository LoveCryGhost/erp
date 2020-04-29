<?php

use App\Models\Admin;
use App\Models\Member;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //User 角色-全限
        $this->UserRoleAndPermission();

        //Staff 角色-全限
        $this->StaffRoleAndPermission();

        //Member 角色-全限
        $this->MemberRoleAndPermission();

        //Admin 角色-全限
        $this->AdminRoleAndPermission();
    }

    public function mass_create_role($guard, $roles)
    {
        foreach($roles as $role => $descripition){
            Role::create(['guard_name' => $guard, 'name' => $role, 'description' => $descripition]);
        }
    }

    public function mass_create_permission($guard, $routes_actions)
    {
        foreach ($routes_actions as $route => $actions){
            foreach ($actions as $action){

                switch ($action){
                    case "*":
                        Permission::create([ 'guard_name' => $guard,
                            'name' => $guard.'.'.$route.'.*',
                        ]);
                        break;

                    case "crud":
                        foreach (['index','create', 'edit', 'show', 'update', 'store', 'destoryed'] as $my_action)
                            Permission::create([ 'guard_name' => $guard,
                                'name' => $guard.'.'.$route.'.'.$my_action,
                            ]);
                        break;

                    default:
                        Permission::create([ 'guard_name' => $guard,
                            'name' => $guard.'.'.$route.'.'.$action,
                        ]);
                        break;
                }
            }
        }
    }

    public function mass_assign_permission($role, $guard, $route, $permissions)
    {
        foreach($permissions as $permission){
            switch ($permission){
                case "*";
                    $role->givePermissionTo($guard.'.'.$route.'.'.$permission);
                    break;
                case "crud":
                    foreach (['index','create', 'edit', 'show', 'update', 'store', 'destoryed'] as $my_action)
                        $role->givePermissionTo($guard.'.'.$route.'.'.$my_action);
                    break;

                default:
                    $role->givePermissionTo($guard.'.'.$route.'.'.$permission);
                    break;
            }

        }
    }

    public function AdminRoleAndPermission()
    {
        //權限 Permissions
        $routes_actions = [
            'logViewer' => ['index'],
            'adminTool' => ['guard_switcher'],

            'adminUser_updatePassword' => ['updatePassword'],
            'adminUser' => ['*', 'crud'],

            'adminStaff_updatePassword' => ['updatePassword'],
            'adminStaff' => ['*', 'crud'],

            'adminMember_updatePassword' => ['updatePassword'],
            'adminMember' => ['*', 'crud'],

            'adminRolePermission' => ['*', 'crud'],
            'adminPermission' => ['*', 'crud'],
            'adminRole' => ['*', 'crud',
                            'assignPermissionToRole','update_nestable_order'],
            'adminStaffRolePermission' => ['*', 'crud']

        ];
        $this->mass_create_permission($guard="admin", $routes_actions);

        //角色 Roles
        $create_roles = ['SupderAdmin' => '超級管理員', 'admin' => '管理員'];
        $this->mass_create_role('admin',$create_roles);

        //Role 綁定 Permission
        $role = Role::where('guard_name','admin')->where('name', 'SupderAdmin')->first();
        $role->givePermissionTo(Permission::where('guard_name', 'admin')->get());

        $role = Role::where('guard_name','admin')->where('name', 'admin')->first();
        $this->mass_assign_permission($role, $guard='admin',$route='adminUser_updatePassword', $permissions=['updatePassword']);
        $this->mass_assign_permission($role, $guard='admin',$route='adminUser', $permissions=['*']);

        $this->mass_assign_permission($role, $guard='admin',$route='adminStaff_updatePassword', $permissions=['updatePassword']);
        $this->mass_assign_permission($role, $guard='admin',$route='adminStaff', $permissions=['*']);

        $this->mass_assign_permission($role, $guard='admin',$route='adminMember_updatePassword', $permissions=['updatePassword']);
        $this->mass_assign_permission($role, $guard='admin',$route='adminMember', $permissions=['*']);

        $this->mass_assign_permission($role, $guard='admin',$route='adminRolePermission', $permissions=['*']);
        $this->mass_assign_permission($role, $guard='admin',$route='adminPermission', $permissions=['*']);
        $this->mass_assign_permission($role, $guard='admin',$route='adminStaffRolePermission', $permissions=['*']);


        //User 綁定 Role
        $admin = Admin::find(1);
        $admin->assignRole('SupderAdmin');

        $admin = Admin::find(2);
        $admin->assignRole('admin');
    }

    public function MemberRoleAndPermission()
    {

        //權限 Permissions
        $routes_actions = [
            'memberExcelLike' => ['*' ,'crud'],
            'supplier' => ['*' ,'crud'],
            'supplierGroup' => ['*' ,'crud'],
            'type' => ['*' ,'crud'],
            'attribute' => ['*' ,'crud'],
            'product' => ['*' ,'crud'],
            'crawlerTask' => ['*' ,'crud'],
            'crawlerItem' => ['*' ,'crud'],
            'reportSKU' => ['crawlerItemAanalysis'],

        ];
        $this->mass_create_permission($guard="member", $routes_actions);

        //角色 Roles
        $create_roles = [
                'guest' => '訪客',
                'supperMember' => '超級會員',
                'member' => '會員',
                'crawlerTask' => '爬蟲任務',
                'crawlerTaskAnalysis' => '爬蟲任務分析',
            ];
        $this->mass_create_role('member',$create_roles);

        $role = Role::where('guard_name','member')->where('name', 'supperMember')->first();
        $role->givePermissionTo(Permission::where('guard_name', 'member')->get());

        $role = Role::where('guard_name','member')->where('name', 'crawlerTask')->first();
        $this->mass_assign_permission($role, $guard='member', $route='crawlerTask', $permissions=['*' ,'crud']);
        $this->mass_assign_permission($role, $guard='member', $route='crawlerItem', $permissions=['*' ,'crud']);


        //User 綁定 Role
        $member = Member::find(1);
        $member->assignRole('supperMember');

        $member = Member::find(2);
        $member->assignRole('crawlerTask');

        $member = Member::find(3);
        $member->assignRole('crawlerTask');

        $member = Member::find(4);
        $member->assignRole('crawlerTask');

        $member = Member::find(5);
        $member->assignRole('crawlerTask');

    }

    public function StaffRoleAndPermission()
    {
        //權限 Permissions
        $routes_actions = [
            'staff' => ['*' ,'crud'],
            'staffExcelLike' => ['*' ,'crud'],
            'staffDepartment' => ['*' ,'crud'],
            'staffList' => ['*' ,'crud'],
            'mhMold' => ['*', 'crud'],
            'reportMHOrder' => ['analysis'],
            'reportMHMold' => ['analysis'],
            'staffExcelView' => ['costSPLabor'],
        ];
        $this->mass_create_permission($guard="staff", $routes_actions);

        //角色 Roles
        $create_roles = [   'guest' => '訪客',
                            'staff-Admin' => '超級員工',
                            'staff-HR' => '人事',
                            'staff-HR-Test' => '人事-測試',
                            'staff-Scheduling' => '排程',
                            'staff-Mold' => '模具',
                            'staff-Cost' => '成本分析'];

        $this->mass_create_role('staff',$create_roles);

        //Role 綁定 Permission
        $role = Role::where('guard_name','staff')->where('name', 'staff-Admin')->first();
        $role->givePermissionTo(Permission::where('guard_name','staff')->get());


        $role = Role::where('guard_name','staff')->where('name', 'staff-HR')->first();
        $this->mass_assign_permission($role, $guard='staff',$route='staff', $permissions=['*']);
        $this->mass_assign_permission($role, $guard='staff',$route='staffDepartment', $permissions=['*']);
        $this->mass_assign_permission($role, $guard='staff',$route='staffList', $permissions=['*']);


        $role = Role::where('guard_name','staff')->where('name', 'staff-HR-Test')->first();
        $this->mass_assign_permission($role, $guard='staff',$route='staff', $permissions=['index']);


        $role = Role::where('guard_name','staff')->where('name', 'guest')->first();
        $this->mass_assign_permission($role, $guard='staff',$route='staff', $permissions=['show']);


        $role = Role::where('guard_name','staff')->where('name', 'staff-Scheduling')->first();
        $this->mass_assign_permission($role, $guard='staff',$route='reportMHOrder', $permissions=['analysis']);


        $role = Role::where('guard_name','staff')->where('name', 'staff-Mold')->first();
        $this->mass_assign_permission($role, $guard='staff',$route='mhMold', $permissions=['*', 'crud']);
        $this->mass_assign_permission($role, $guard='staff',$route='reportMHMold', $permissions=['analysis']);


        //Staff 綁定 Role
        $staff = Staff::find(1);
        $staff->assignRole('guest', 'staff-Admin');

        $staff = Staff::find(2);
        $staff->assignRole('guest', 'staff-HR');

        $staff = Staff::find(3);
        $staff->assignRole('guest', 'staff-HR-Test');

        $staff = Staff::find(4);
        $staff->assignRole('guest', 'staff-Scheduling');

        $staff = Staff::find(5);
        $staff->assignRole('guest', 'staff-Mold');

    }

    public function UserRoleAndPermission()
    {
        //權限 Permissions
        $routes_actions = [
            'staff' => ['*' ,'crud'],
            'staffExcelLike' => ['*' ,'crud'],
            'staffDepartment' => ['*' ,'crud'],
            'staffList' => ['*' ,'crud'],
        ];
        $this->mass_create_permission($guard="user", $routes_actions);

        //角色 Roles
        $create_roles = ['guest' => '訪客'];
        $this->mass_create_role('web',$create_roles);

        //Role 綁定 Permission
        $role = Role::where('guard_name','web')->where('name', 'guest')->first();
        $role->givePermissionTo(Permission::where('guard_name','web')->get());

        //User 綁定 Role
        $user = User::find(1);
        $user->assignRole('guest');
    }
}