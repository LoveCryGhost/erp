<?php
//Admin
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

    Route::middleware('auth:admin')->get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    //Guard-Switcher-User
    Route::post('tool/guard_switcher_user', 'AdminToolsController@guard_switcher_user')->name('tool.guard_switcher_user');

    //AdminUser
    Route::put('user_update_password/{user}', 'AdminUsersController@update_password')->name('user.update_password');
    Route::resource('user', 'AdminUsersController');

    //AdminMember
    Route::put('member_update_password/{member}', 'AdminMembersController@update_password')->name('member.update_password');
    Route::resource('member', 'AdminMembersController');

    //AdminMember
    Route::put('staff_update_password/{staff}', 'AdminStaffsController@update_password')->name('staff.update_password');
    Route::resource('staff', 'AdminStaffsController');

    Route::get('crawler_monitor', 'AdminMonitorsController@crawler_monitor')->name('crawler.monitor');
    Route::resource('permission', 'AdminPermissionsController');
    Route::resource('role', 'AdminRolesController');

    //指派Staff權限
    Route::resource('assign_staff_role_permission', 'AdminStaffAssignRolePermissionsController');

});
Route::resource('admin', 'AdminsController');
