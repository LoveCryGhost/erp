<?php

//User
use Illuminate\Support\Facades\Route;


Route::middleware('')->prefix('')->namespace('User')->name('')->group(function(){
    //???為何要放在 middleware('auth') 下面
    Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
});