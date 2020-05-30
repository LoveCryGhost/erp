<?php

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Models\Shoes\ShoesDB;
use App\Models\SKU;
use App\Models\SKUSupplier;
use App\Models\Supplier;
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
include('route_test_mysql.php');





//無用的Test
Route::prefix('test') ->middleware('auth:admin')->group(function(){
    Route::get('/console',function (){
        $sub_domain = current(explode('.', request()->getHost()));
    });

    Route::get('/subDomain',function (){
        $sub_domain = current(explode('.', request()->getHost()));
        dd($sub_domain, explode('-', $sub_domain)[0]);
    });

    Route::get('/translation_create',function (){
        $sku = SKU::find(1);

        $a = $sku->skuSuppliers()->attach([
            3 => [
                'price' => rand(1,9),
                'random'=> rand(1,999999999999999)
            ]
        ]);

        $skuSupplier = SKUSupplier::latest()->first();
        $sku->skuSuppliers()->updateExistingPivot(
            $skuSupplier , [
            'price' => rand(1,9),
            'random' => rand(1,999999999999999)
        ]);
    });

    Route::get('/translation_update',function (){
        $sku = SKU::find(2);
        $skuSupplier = Supplier::find(2);

        //利用$sku & $skuSupplier => 得到 ss_id => 也就是 trnalation 中的 sku_id
        $sku->skuSuppliers()->updateExistingPivot(
            $skuSupplier , [
            'price' => rand(1,9),
            'random' => rand(1,999999999999999)
        ]);

    });

    Route::get('/MemberCrawlerItemCount',function (){
        $query = CrawlerItem::whereHas('crawlerTask', function ($query) {
            $query->where('member_id', '>', 5)
                ->orderBy('member_id', 'DESC');
        });

        $query_total =  $query->count();

        $query_none_updated = $query->where(function ($query) {
            $query->whereDate('updated_at','<>',Carbon::today())->orWhereNull('updated_at');
        })->count();

        $query_updated =  $query_total - $query_none_updated;
        $query_updated_percentage = number_format(($query_updated/$query_total)*100, 1, ".","");

        $query_updated = number_format($query_updated,0,'',',');

        $query_updated = number_format($query_updated,0,'',',');
        $query_total = number_format($query_total,0,'',',');


        dd('員所建立的 MemberCrawlerItem 數量 (已更新/總數) : '. ($query_updated).'/'.$query_total. ' ( '.$query_updated_percentage.'%)');
    });

    Route::get('/CategoryCrawlerItemCount',function (){
        $query = CrawlerItem::whereHas('crawlerTask', function ($query) {
            $query->where('member_id', '<=', 5)
                ->orderBy('member_id', 'ASC');
            ;
        });
        $query_total =  $query->count();

        $query_none_updated = $query->where(function ($query) {
            $query->whereDate('updated_at','<>',Carbon::today())->orWhereNull('updated_at');
        })->count();

        $query_updated =  $query_total - $query_none_updated;
        $query_updated_percentage = number_format(($query_updated/$query_total)*100, 1, ".","");

        $query_updated = number_format($query_updated,0,'',',');

        $query_updated = number_format($query_updated,0,'',',');
        $query_total = number_format($query_total,0,'',',');


        dd('非員所建立的 CategoryCrawlerItem 數量 (已更新/總數) : '. ($query_updated).'/'.$query_total. ' ( '.$query_updated_percentage.'%)');
    });



});

