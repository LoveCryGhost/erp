<?php
//Staff
use Illuminate\Support\Facades\Route;

// 生成  Dashboard
// http://localhost.com/
Route::prefix('')->namespace('Staff')
    ->middleware('auth:staff')
    ->name('staff.')
    ->group(function(){
    // http://localhost.com/staff/
    Route::prefix('staff')->group(function(){
        //ExcelLike
        Route::resource('staffExcelLike', 'StaffExcelLikeController');

        //Dashboard
        Route::get('dashboard', 'StaffDashboardsController@dashboard')->name('staff.dashboard');

        //staffList
        Route::get('staffList', 'StaffsController@list')->name('staff.staffLlist');;

        //Staff
        Route::resource('staff', 'StaffsController');

        //StaffDepartment
        Route::resource('staffDepartment', 'StaffDepartmentsController');
    });

    //更新密碼
    Route::put('staff_update_password/{staff}', 'StaffsController@update_password')->name('update_password');

    //Report
    Route::prefix('staff')->namespace('MH\Report')->group(function() {
        Route::get('reportMHOrder_analysis', 'ReportMHOrdersController@analysis')->name('reportMHOrder.analysis');
        Route::get('download_shoes_analysis_with_size', 'ReportMHOrderController@download_shoes_analysis_with_size')->name('staff.mh.report.download_shoes_analysis_with_size');
    });


});

