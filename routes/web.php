<?php
use Illuminate\Support\Facades\Route;
use App\Handlers\ShopeeHandler;
use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Repositories\Member\MemberCoreRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    return view('welcome');
});



//======================================================================================================================
//MultiAuth 用戶分份驗證相關路由
Auth::routes(['verify' => true]);
Route::get('/admin/horizon', function () {
    return redirect()->route('horizon.index');
});


//======================================================================================================================
//MultiAuth 用戶分份驗證相關路由
Route::prefix('')->group(function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // 用户注册相关路由
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // 密码重置相关路由
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Email 认证相关路由
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

    //Admin
    Route::prefix('admin')->group(function() {
        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
        Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
        //Password Reset Route
        Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showRequestForm')->name('admin.password.request');
        Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
        Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    });

    //Member
    Route::prefix('member')->group(function() {
        Route::get('/login', 'Auth\MemberLoginController@showLoginForm')->name('member.login');
        Route::post('/login', 'Auth\MemberLoginController@login')->name('member.login.submit');
        Route::post('/logout', 'Auth\MemberLoginController@logout')->name('member.logout');

        //Password Reset Route
        Route::post('/password/email', 'Auth\MemberForgotPasswordController@sendResetLinkEmail')->name('member.password.email');
        Route::get('/password/reset', 'Auth\MemberForgotPasswordController@showRequestForm')->name('member.password.request');
        Route::post('/password/reset', 'Auth\MemberResetPasswordController@reset')->name('member.password.update');
        Route::get('/password/reset/{token}', 'Auth\MemberResetPasswordController@showResetForm')->name('member.password.reset');
    });

    //Staff
    Route::prefix('staff')->group(function() {
        Route::get('/login', 'Auth\StaffLoginController@showLoginForm')->name('staff.login');
        Route::post('/login', 'Auth\StaffLoginController@login')->name('staff.login.submit');
        Route::post('/logout', 'Auth\StaffLoginController@logout')->name('staff.logout');

        //Password Reset Route
        Route::post('/password/email', 'Auth\StaffForgotPasswordController@sendResetLinkEmail')->name('staff.password.email');
        Route::get('/password/reset', 'Auth\StaffForgotPasswordController@showRequestForm')->name('staff.password.request');
        Route::post('/password/reset', 'Auth\StaffResetPasswordController@reset')->name('staff.password.update');
        Route::get('/password/reset/{token}', 'Auth\StaffResetPasswordController@showResetForm')->name('staff.password.reset');
    });
});


//======================================================================================================================
//User
Route::middleware('auth')->prefix('')->namespace('User')->name('')->group(function(){
    Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
});


//====================================================================
//Admin
Route::prefix('')->namespace('Admin')->group(function(){
    Route::prefix('admin')->name('admin.')->group(function(){

        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

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

    });
    Route::resource('admin', 'AdminsController');

});

//======================================================================================================================
//Member
Route::prefix('member')->namespace('Member')->group(function(){
    Route::put('member_update_password/{member}', 'MembersController@update_password')->name('member.update_password');
    Route::resource('member', 'MembersController');
    Route::prefix('')->name('member.')->group(function(){

        //SupplierGroup
        Route::resource('supplier', 'SuppliersController');
        Route::resource('supplierGroup', 'SupplierGroupsController');
        Route::resource('supplier-contact', 'Supplier_ContactsController');

        //Type
        Route::resource('type', 'TypesController');
        Route::resource('type-attribute', 'Types_AttributesController');

        //Attribute
        Route::resource('attribute', 'AttributesController');

        //Product
        Route::resource('product', 'ProductsController');
        Route::resource('product-sku', 'Product_SKUsController');
        Route::resource('product-sku-supplier', 'Product_SKU_SuppliersController');

        //Crawler
        Route::resource('crawlertask', 'CrawlerTasksController');
        Route::post('crawlertask_refresh', 'CrawlerTasksController@refresh')->name('crawler.refresh');
        Route::resource('crawleritem', 'CrawlerItemsController');
        Route::post('crawleritem_toggle', 'CrawlerItemsController@toggle')->name('crawleritem.toggle');
        Route::post('crawleritem_save_cralwertask_info', 'CrawlerItemsController@save_cralwertask_info')->name('crawleritem.save_cralwertask_info');

        Route::resource('crawleritemsku', 'CrawlerItemSKUsController');
        Route::post('crawleritemsku-put_product_id', 'CrawlerItemSKUsController@put_product_id')->name('crawleritemsku.put_product_id');
        Route::post('crawleritemsku-show_product_skus', 'CrawlerItemSKUsController@show_product_skus')->name('crawleritemsku.show_product_skus');
        Route::post('crawleritemsku-bind_product_sku_to_crawler_sku', 'CrawlerItemSKUsController@bind_product_sku_to_crawler_sku')->name('crawleritemsku.bind_product_sku_to_crawler_sku');

    });


    //Member - Report
    Route::prefix('')->namespace('Report')->name('member.reports.sku.')->group(function(){
        Route::get('crawleritem_analysis', 'ReportSKUController@crawleritem_analysis')->name('crawleritem_analysis');
    });
});


//======================================================================================================================
//Staff
Route::prefix('')->namespace('Staff')->group(function(){
    Route::put('staff_update_password/{staff}', 'StaffsController@update_password')->name('staff.update_password');
    Route::prefix('staff')->name('staff.')->group(function(){
        Route::get('dashboard', 'StaffDashboardsController@dashboard')->name('staff.dashboard');

        Route::get('staff_list', 'StaffsController@list')->name('staff.staff_list');;
        Route::resource('staff', 'StaffsController');
        Route::resource('staff-department', 'Staff_DepartmentsController');
    });
});



Route::get('/', function () {
    return view('theme.cryptoadmin.user.welcome');
});


include('test.php');
include('route_test_crawler_item_job.php');









