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
        Route::get('adminRole_showAllPermission', 'AdminRolesController@showAllPermission')->name('adminRole.showAllPermission'); //RolePermission
        Route::post('adminRole_assignPermissionToRole', 'AdminRolesController@assignPermissionToRole')->name('adminRole.assignPermissionToRole'); //RolePermission
        Route::post('adminRole_update_nestable_order', 'AdminRolesController@update_nestable_order')->name('adminRole.update_nestable_order'); //RolePermission


        //指派Staff權限
        Route::resource('adminStaffRolePermission', 'AdminStaffRolePermissionsController'); //RolePermission

        //Crawler
            Route::resource('adminCrawlerTask', 'AdminCrawlerTasksController'); //RolePermission
            Route::resource('adminCrawlerItem', 'AdminCrawlerItemsController'); //RolePermission

        //Run
            Route::get('runTaskToMember', 'RunController@taskToMember')->name('run.taskToMember'); //RolePermission
            Route::get('runTaskItemToMember', 'RunController@taskItemToMember')->name('run.taskItemToMember'); //RolePermission
            Route::get('taskItemToMemberRefresh', 'RunController@taskItemToMemberRefresh')->name('run.taskItemToMemberRefresh'); //RolePermission


    });
    Route::resource('admin', 'AdminsController'); //RolePermission
});
