<?php
//MultiAuth 用戶分份驗證相關路由
use Illuminate\Support\Facades\Route;

//Guard
Route::prefix('')->group(function() {
    //User
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

