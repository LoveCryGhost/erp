<?php

use App\Jobs\CrawlerCategoryJob;
use Illuminate\Support\Facades\Route;

Route::prefix('run') ->middleware('auth:admin')->group(function(){
    Route::get('crawlerCategoryJob',function () {
        dispatch((new CrawlerCategoryJob())->onQueue('high'));
        return redirect()->route('admin.index');
    });
    Route::get('test',function () {
        return redirect()->route('admin.index');
    });
});
