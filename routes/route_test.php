<?php

use Illuminate\Support\Facades\Route;

include('test.php');
include('route_test_crawler_item_job.php');
include('mh_erp.php');

Route::get('/', function () {
    return view('theme.cryptoadmin.user.welcome');
});
