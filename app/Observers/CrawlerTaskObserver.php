<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Jobs\CrawlerTaskJob;
use App\Models\CrawlerTask;
use Illuminate\Support\Facades\Auth;


class CrawlerTaskObserver extends Observer
{

    public function saving(CrawlerTask $crawlerTask)
    {
        if(request()->is_active == 1 or request()->is_active == true or  $crawlerTask->is_active==1){
            $crawlerTask->is_active = 1;
        }else{
            $crawlerTask->is_active = 0;
        }
        //判別是否為admin建立
        if(Auth::guard('member')->user()!=null) {
            $crawlerTask->member_id = Auth::guard('member')->user()->id;
        }
        $crawlerTask->timestamps = false;
        $crawlerTask->created_at = now();
    }

    public function creating(CrawlerTask $crawlerTask)
    {

    }

    public function created(CrawlerTask $crawlerTask)
    {
        $crawlerTask->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.crawlertask'), $crawlerTask->ct_id);
        $crawlerTask->save();
    }

    public function updating(CrawlerTask $crawlerTask)
    {
    }

    public function saved(CrawlerTask $crawlerTask)
    {

    }

    public function deleted( CrawlerTask $crawlerTask)
    {

    }
}


