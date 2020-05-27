<?php

use App\Imports\MHMoldImport;
use App\Jobs\CrawlerCategoryJob;
use App\Jobs\CrawlerItemJob;
use App\Jobs\CrawlerShopJob;
use App\Jobs\CrawlerSubCategoryJob;
use App\Jobs\CrawlerTaskJob;
use App\Models\Shoes\ShoesDB;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

Route::prefix('run') ->middleware('auth:admin')->group(function(){
    Route::get('crawlerCategoryJob',function () {
        dispatch((new CrawlerCategoryJob())->onQueue('high'));
        return redirect()->back();
    })->name('member.run.crawlerCategoryJob');

    Route::get('crawlerSubCategoryJob',function () {
        dispatch((new CrawlerSubCategoryJob())->onQueue('high'));
        return redirect()->back();
    })->name('member.run.crawlerSubCategoryJob');

    Route::get('crawlerTaskJob',function () {
        dispatch((new CrawlerTaskJob())->onQueue('default'));
        return redirect()->back();
    })->name('member.run.crawlerTaskJob');

    Route::get('crawlerItemJob',function () {
        dispatch((new CrawlerItemJob())->onQueue('low'));
        return redirect()->back();
    })->name('member.run.crawlerItemJob');

    Route::get('crawlerShopJob',function () {
        dispatch((new CrawlerShopJob())->onQueue('low'));
        return redirect()->back();
    })->name('member.run.crawlerShopJob');

    Route::get('test',function () {
        return redirect()->back();
    });


});











