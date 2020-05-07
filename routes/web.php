<?php
/* *
 * // Route 路由命名規則
 * web.com/Guard/abcMaster-subDetail@controllerMethod
 * web.com/Guard/guardMaster => 多個guard都有的功能
 *
 *
 * // Route Name 命名規則
 * ->name(guard.guardMaster.ontrollerMethod)
 * ->name(abcMaster-subDetail@controllerMethod)
 * [註1] ex: AdminsController@create  => name->(admins.create)
 * [註2] ex: AdminsController@create  => name->(admins.create)
 *
 * // RolePermission 命名規則
 * guard.abcMaster.controllerMethod@button
 * guard.abcMaster-subDetail.controllerMethod@button
 *
 * // Controller 命名規則
 *
 * // Blade規則
 *
 *
 * */


use App\Jobs\CrawlerTaskJob;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/console', function () {
    dispatch((new CrawlerTaskJob())->onQueue('high'));
});



// 語言 Language
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

@include('route_test.php');
@include('route_tools.php');
@include('route_guard.php');
@include('route_user.php');
@include('route_member.php');
@include('route_staff.php');
@include('route_staff_mh.php');
@include('route_admin.php');













