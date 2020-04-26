<?php

use App\Imports\MHMoldImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


include('test.php');
include('route_test_crawler_item_job.php');
include('mh_erp.php');

Route::get('/', function () {
    return view('theme.cryptoadmin.user.welcome');
});

Route::prefix('test') ->group(function(){
    Route::get('excelImport',function (){
        DB::table('mh_shoes_molds')->truncate();
        Excel::import(new MHMoldImport(), storage_path('app/MHMoldExcelImport.xlsx'));
        return redirect()->route('staff.mhMold.index', );
    });
});

