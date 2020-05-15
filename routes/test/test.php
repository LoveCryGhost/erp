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

//有用的Test
include('test_mh_erp.php');
include('route_test_crawlerTaskJob.php');
include('route_test_crawlerCategoryJob.php');
include('route_test_crawlerSubCategoryJob.php');





//無用的Test
Route::prefix('test') ->middleware('auth:admin')->group(function(){
    Route::get('/console',function (){
        $sub_domain = current(explode('.', request()->getHost()));
    });


});

