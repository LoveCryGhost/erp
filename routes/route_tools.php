<?php
//MultiAuth 用戶分份驗證相關路由
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
Route::get('/admin/horizon', function () {
    return redirect()->route('horizon.index');
});