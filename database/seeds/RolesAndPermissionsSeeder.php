<?php

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

        // create permissions
        //Staff 資料
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.index']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.show']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.edit']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.create']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.destroy']);

        //staffExcelLike
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staffExcelLike.*']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staffExcelLike.index']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staffExcelLike.edit']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staffExcelLike.create']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staffExcelLike.show']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['guard_name' => 'staff', 'name' => 'SP-Manager']);
        $role->givePermissionTo('staff.staffExcelLike.index');

        // or may be done by chaining
        $role = Role::create(['guard_name' => 'staff', 'name' => 'SP-Editor'])
            ->givePermissionTo(['staff.staffExcelLike.index', 'staff.staffExcelLike.edit']);

        $role = Role::create(['guard_name' => 'staff', 'name' => 'SP-Admin']);
        $role->givePermissionTo(Permission::all());



        $staff = Staff::find(1);
        $staff->assignRole('SP-Admin', 'SP-Manager','SP-Editor');

        $staff = Staff::find(2);
        $staff->assignRole('SP-Manager', 'SP-Editor');

        $staff = Staff::find(3);
        $staff->assignRole('SP-Editor');

        Permission::create([ 'guard_name' => 'member', 'name' => 'memberExcelLike.show']);
        $role = Role::create(['guard_name' => 'member', 'name' => 'Member-Role']);
        $role->givePermissionTo(['memberExcelLike.show']);

        $member = Member::find(1);
        $member->assignRole('Member-Role');
    }
}