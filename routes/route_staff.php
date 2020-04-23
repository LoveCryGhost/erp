<?php
//Staff
use Illuminate\Support\Facades\Route;

Route::prefix('')->namespace('Staff')->group(function(){
    Route::put('staff_update_password/{staff}', 'StaffsController@update_password')->name('staff.update_password');
    Route::prefix('staff')->name('staff.')->group(function(){
        Route::get('dashboard', 'StaffDashboardsController@dashboard')->name('staff.dashboard');
        Route::get('staff_list', 'StaffsController@list')->name('staff.staff_list');;
        Route::resource('staff', 'StaffsController');
        Route::resource('staff-department', 'Staff_DepartmentsController');
    });

    //Report
    Route::prefix('staff')->namespace('MH\Report')->group(function() {
        Route::get('order-analysis', 'ReportMHOrderController@analysis')->name('staff.mh.report.order_analysis');
        Route::get('download_shoes_analysis_with_size', 'ReportMHOrderController@download_shoes_analysis_with_size')->name('staff.mh.report.download_shoes_analysis_with_size');
    });
});

//Staff
Route::prefix('staff')->name('staff.')->namespace('Staff')->group(function(){
    //ExcelLike
    Route::resource('staffExcelLike', 'StaffExcelLikeController');
});