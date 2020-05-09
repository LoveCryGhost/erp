<?php

use App\Imports\MHMoldImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


include('test/test.php');

include('test/test_mh_erp.php');
include('test/route_test_crawlerTaskJob.php');
include('test/route_test_crawlerCategoryJob.php.php');


include('test/run.php');

Route::get('/', function () {
    return view('theme.cryptoadmin.user.welcome');
});

Route::prefix('test') ->middleware('auth:admin')->group(function(){
    Route::get('excelImport',function (){
        DB::table('mh_shoes_molds')->truncate();
        Excel::import(new MHMoldImport(), storage_path('app/MHMoldExcelImport.xlsx'));
        return redirect()->route('staff.mhMold.index', );
    });

    Route::get('nestable',function (){
        if(request()->input('submit')=="get"){
            $output = request()->input('nestable_output');
            $output = json_decode($output);
        }
       return view('test.nestable');
    });

    Route::get('spreadjs',function (){
        return view('test.spreadjs');
    });

    Route::get('blade',function (){
        return view('test.blade.index');
    });
});



