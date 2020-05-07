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




Route::prefix('run') ->middleware('auth:admin')->group(function(){
    Route::get('crawlerCategoryJob',function (){
        dispatch((new CrawlerCategoryJob())->onQueue('high'));
    });
});











