<?php

use App\Models\Admin;
use App\Models\Member;
use App\Models\Staff;
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
        foreach($roles as $role){
            Role::create(['guard_name' => $guard, 'name' => $role]);
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
            'adminStaffRolePermission' => ['*', 'crud']

        ];
        $this->mass_create_permission($guard="admin", $routes_actions);

        //角色 Roles
        $create_roles = ['SupderAdmin','admin'];
        $this->mass_create_role('admin',$create_roles);

        //Role 綁定 Permission
        $role = Role::where('guard_name','admin')->where('name', 'SupderAdmin')->first();
//        $role->givePermissionTo(Permission::where('guard_name', 'admin')->get());

        $role = Role::where('guard_name','admin')->where('name', 'admin')->first();
        $role->givePermissionTo([
            'admin.adminUser_updatePassword.updatePassword',
            'admin.adminUser.*',

            'admin.adminStaff_updatePassword.updatePassword',
            'admin.adminStaff.*',

            'admin.adminMember_updatePassword.updatePassword',
            'admin.adminMember.*',

            'admin.adminRolePermission.*',
            'admin.adminPermission.*',
            'admin.adminStaffRolePermission.*',
        ]);


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
            'memberExcelLike' => ['*' ,'crud']
        ];
        $this->mass_create_permission($guard="member", $routes_actions);

        //角色 Roles
        $create_roles = ['guest', 'member'];
        $this->mass_create_role('member',$create_roles);


    }

    public function StaffRoleAndPermission()
    {
        //權限 Permissions
        $routes_actions = [
            'staff' => ['*' ,'crud'],
            'staffExcelLike' => ['*' ,'crud']
        ];
        $this->mass_create_permission($guard="staff", $routes_actions);

        //角色 Roles
        $create_roles = ['guest', 'staff'];
        $this->mass_create_role('staff',$create_roles);

        //Role 綁定 Permission
        $role = Role::where('guard_name','staff')->where('name', 'guest')->first();
        $role->givePermissionTo('staff.staff.show');
        $role->givePermissionTo('staff.staff.edit');
        $role->givePermissionTo('staff.staff.update');

        //User 綁定 Role
        $staff = Staff::find(1);
        $staff->assignRole('guest', 'staff');

    }

    public function UserRoleAndPermission()
    {
        $create_roles = ['guest'];
        $this->mass_create_role('web',$create_roles);
    }
}