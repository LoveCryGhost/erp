<?php

use App\Jobs\CrawlerCategoryJob;

use App\Jobs\CrawlerItemJob;
use App\Jobs\CrawlerShopJob;
use App\Jobs\CrawlerTaskJob;
use Illuminate\Support\Facades\Route;

Route::prefix('run') ->middleware('auth:admin')->group(function(){
    Route::get('crawlerCategoryJob',function () {
        dispatch((new CrawlerCategoryJob())->onQueue('high'));
        return redirect()->route('admin.index');
    });
    Route::get('crawlerTaskJob',function () {
        dispatch((new CrawlerTaskJob())->onQueue('default'));
        return redirect()->route('admin.index');
    });
    Route::get('crawlerItemJob',function () {
        dispatch((new CrawlerItemJob())->onQueue('low'));
        return redirect()->route('admin.index');
    });
    Route::get('crawlerShopJob',function () {
        dispatch((new CrawlerShopJob())->onQueue('low'));
        return redirect()->route('admin.index');
    });
    Route::get('test',function () {
        return redirect()->route('admin.index');
    });
});
