<?php

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
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staff@index']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staff@show']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staff@edit']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staff@insert']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.staff@delete']);

        //excel_like
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.excel_like@index']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.excel_like@edit']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.excel_like@insert']);
        Permission::create([ 'guard_name' => 'staff', 'name' => 'staff.excel_like@show']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['guard_name' => 'staff', 'name' => 'SP-Manager']);
        $role->givePermissionTo('staff.excel_like@index');

        // or may be done by chaining
        $role = Role::create(['guard_name' => 'staff', 'name' => 'SP-Editor'])
            ->givePermissionTo(['staff.excel_like@index', 'staff.excel_like@edit']);

        $role = Role::create(['guard_name' => 'staff', 'name' => 'SP-Admin']);
        $role->givePermissionTo(Permission::all());
    }
}