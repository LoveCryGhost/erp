<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerItem;
use App\Models\CrawlerShop;
use App\Models\CrawlerTask;
use App\Repositories\Member\MemberCoreRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function config;
use function current;
use function dd;
use function dispatch;
use function explode;
use function json_decode;
use function request;

class TaskItemToMemberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {

    }

    public function handle()

    {

        $crawlerTask = $this->crawlerTask();

        $categoryTask = CrawlerTask::whereIn('member_id',[2,3,4,5])
            ->where('is_active' , 0)
            ->where('category' , $crawlerTask->category)
            ->where('subcategory' , $crawlerTask->subcategory)
            ->where('domain_name' , $crawlerTask->domain_name)
            ->where('ct_name' , $crawlerTask->ct_name)
            ->where('locale' , $crawlerTask->locale)
            ->where('sort_by',$crawlerTask->sort_by)
            ->where('locations' , $crawlerTask->locations)
            ->where('url' , $crawlerTask->url)
            ->where('website', $crawlerTask->website)
            ->first();


        if($categoryTask) {
            foreach ($categoryTask->crawlerItems as $crawlerItem){
                //商品資訊
                $sync_ids[$crawlerItem->pivot->ci_id] = [
                    'sort_order' => $crawlerItem->pivot->sort_order
                ];
            }
            if(count($sync_ids)>0) {
                $crawlerTask->crawlerItems()->sync($sync_ids);
            }

            $crawlerTask->updated_at = Carbon::now();
            $crawlerTask->save();

            dispatch((new TaskItemToMemberJob())->onQueue('instant'));
        }
    }

    /*
     * 更新Task
     * 條件 今天未更新 或 從為更新過 updated_at == null
    */
    public function crawlerTask()
    {
        $query = CrawlerTask::with(['crawlerItems'])->where(function ($query) {
            $query->whereDate('updated_at','<>',Carbon::today())
                ->orWhereNull('updated_at');

        })->where('is_active', 0);
        $crawlerTask = $query->first();
        return $crawlerTask;
    }
}

