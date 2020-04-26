<?php
//Staff
use Illuminate\Support\Facades\Route;

// 生成  Dashboard
// http://localhost.com/
Route::prefix('')->namespace('Staff')
    ->middleware('auth:staff')
    ->group(function(){
    // http://localhost.com/staff/
    Route::prefix('staff')->name('staff.')->group(function(){
        Route::namespace('MH')->group(function() {
            Route::resource('mhMold', 'MHMoldsController');
        });
    });

    //Report
    Route::prefix('staff')->namespace('MH\Report')->name('staff.')->group(function() {
        //訂單
        Route::get('reportMHOrder_analysis', 'ReportMHOrdersController@analysis')->name('reportMHOrder.analysis');
        Route::get('download_shoes_analysis_with_size', 'ReportMHOrderController@download_shoes_analysis_with_size')->name('mh.report.download_shoes_analysis_with_size');

        //模具
        Route::get('reportMHMold_analysis', 'ReportMHMoldsController@analysis')->name('reportMHMold.analysis');

    });

});

