<?php

use App\Handlers\ShopeeHandler;
use App\Jobs\CrawlerItemJob;
use App\Models\CrawlerItem;
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
    Route::get('excel_like', 'TestController@excel_like')->name('test.excel_like');;
});


