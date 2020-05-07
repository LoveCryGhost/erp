<?php

use App\Imports\MHMoldImport;
use App\Jobs\CrawlerCategoryJob;
use App\Jobs\CrawlerTaskJob;
use App\Models\Shoes\ShoesDB;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

//無用的Test
include('test/test.php');

//有用的Test
include('test/test_mh_erp.php');
include('test/route_test_crawlerTaskJob.php');
include('test/route_test_crawlerCategoryJob.php');

//Route::get('/', function () {
//    return view('theme.cryptoadmin.user.welcome');
//});

Route::prefix('test') ->middleware('auth:admin')->group(function(){
//    Route::get('excelImport',function (){
//        DB::table('mh_shoes_molds')->truncate();
//        Excel::import(new MHMoldImport(), storage_path('app/MHMoldExcelImport.xlsx'));
//        return redirect()->route('staff.mhMold.index', );
//    });
//
//    Route::get('nestable',function (){
//        if(request()->input('submit')=="get"){
//            $output = request()->input('nestable_output');
//            $output = json_decode($output);
//        }
//       return view('test.nestable');
//    });
//
//    Route::get('spreadjs',function (){
//        return view('test.spreadjs');
//    });
//
//    Route::get('blade',function (){
//        return view('test.blade.index');
//    });

    Route::get('crawlerCategoryJob',function (){
        dispatch((new CrawlerCategoryJob())->onQueue('high'));
    });
});


Route::get('/test', function () {
    //dd( storage_path('app/curl/cacert.pem'));
    return response()->download(storage_path('app/curl/cacert.pem'));

});

/*
 * ExcelLike
 * */
Route::prefix('test')->namespace('Test')->group(function(){
    Route::get('excel_like', 'TestController@excel_like')->name('test.excel_like');
});

Route::prefix('')->group(function(){
    Route::get('mh_shoes_db', function(){
        $shoes_dbs = ShoesDB::get();
        foreach ($shoes_dbs->first()->sizes as $size => $qty){
            if($qty!=0){
                $size_array[$size] = $qty;
            }
        }
        dd($size_array);
    });
});

Route::prefix('')->group(function(){
    Route::get('python-link', function(){
//        ini_set("memory_limit", "256M");
//        ini_set ('max_execution_time',  0);
        set_time_limit(0);

        echo '<br>開始<br>';
        $process = new Process(['/usr/bin/python',
            storage_path('python/test/Download_MaterialControl.py'),
            storage_path('python/download'),
            Carbon::now()->subDays(5)->format('Y/m/d'), Carbon::now()->format('Y/m/d')]);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();

        echo '<br>結束<br>';
    });
});





