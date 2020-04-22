<?php

use App\Handlers\ShopeeHandler;
use App\Jobs\CrawlerItemJob;
use App\Models\CrawlerItem;
use App\Models\Shoes\ShoesDB;
use App\Repositories\Member\MemberCoreRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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

