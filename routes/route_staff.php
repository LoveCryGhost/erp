<?php
//Staff
use Illuminate\Support\Facades\Route;

// 生成  Dashboard
// http://localhost.com/
Route::prefix('')->namespace('Staff')->group(function(){
    // http://localhost.com/staff/
    Route::prefix('staff')->name('staff.')->group(function(){
        //ExcelLike
        Route::resource('staffExcelLike', 'StaffExcelLikeController');

        //Dashboard
        Route::get('dashboard', 'StaffDashboardsController@dashboard')->name('staff.dashboard');

        //staff_list
        Route::get('staff_list', 'StaffsController@list')->name('staff.staff_list');;

        //Staff
        Route::resource('staff', 'StaffsController');

        //StaffDepartment
        Route::resource('staff-department', 'Staff_DepartmentsController');
    });

    //更新密碼
    Route::put('staff_update_password/{staff}', 'StaffsController@update_password')->name('staff.update_password');

    //Report
    Route::prefix('staff')->namespace('MH\Report')->group(function() {
        Route::get('order-analysis', 'ReportMHOrderController@analysis')->name('staff.mh.report.order_analysis');
        Route::get('download_shoes_analysis_with_size', 'ReportMHOrderController@download_shoes_analysis_with_size')->name('staff.mh.report.download_shoes_analysis_with_size');
    });


});

