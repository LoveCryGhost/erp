<?php
//Admin
use Illuminate\Support\Facades\Route;

// 生成Dashboard
Route::prefix('')->namespace('Admin')->group(function(){
    Route::prefix('admin')->name('admin.')
        ->middleware('auth:admin')
        ->group(function(){

        Route::get('logViewer', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')
            ->middleware(['permission:admin.logViewer.index'])
            ->name('logViewer.index'); //RolePermission

        //Guard-Switcher-User
        Route::post('adminTool', 'AdminToolsController@guard_switcher')->name('adminTool.guard_switcher'); //RolePermission

        //AdminUser
        Route::put('adminUser_updatePpassword/{user}', 'AdminUsersController@updatePpassword')->name('adminUser.updatePpassword'); //RolePermission
        Route::resource('adminUser', 'AdminUsersController'); //RolePermission

        //AdminMember
        Route::put('adminMember_updatePassword/{adminMember}', 'AdminMembersController@updatePassword')->name('adminMember.updatePassword'); //RolePermission
        Route::resource('adminMember', 'AdminMembersController'); //RolePermission

        //AdminMember
        Route::put('adminStaff_updatePassword/{adminStaff}', 'AdminStaffsController@updatePassword')->name('adminStaff.updatePassword'); //RolePermission
        Route::resource('adminStaff', 'AdminStaffsController'); //RolePermission

        Route::resource('adminPermission', 'AdminPermissionsController'); //RolePermission
        Route::resource('adminRole', 'AdminRolesController'); //RolePermission

        //指派Staff權限
        Route::resource('adminStaffRolePermission', 'AdminStaffRolePermissionsController'); //RolePermission

    });
    Route::resource('admin', 'AdminsController'); //RolePermission
});
