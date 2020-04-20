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


