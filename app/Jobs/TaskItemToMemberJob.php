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

    private $url;
    private $shopeeHandler;
    private $crawlerTask;

    public function __construct()
    {
    }

    public function handle()
    {
        $crawlerTask = $this->crawlerTask();
        if($crawlerTask) {
            foreach($crawlerTask->crawlerItems as $crawlerItem){
                //商品資訊
                $sync_ids[] = [
                    $crawlerItem->ci_id => [
                        'sort_order' => $crawlerItem->pivot->sort_order
                    ]
                ];
            }
            foreach ($items_order as $itemid){
                $sync_ids[$crawlerItem_ids[$itemid]]= ['sort_order'=>$index++];
            }
            //Sync刪除並更新
            $crawlerTask->crawlerItems()->sync($sync_ids);
        }

        $crawlerTask->updated_at = Carbon::now();
        $crawlerTask->save();
        dispatch((new TaskItemToMemberJob())->onQueue('instant'));
    }



    public function crawlerTask()
    {
        $query = CrawlerTask::where(function ($query) {
            $query->whereDate('updated_at','<>',Carbon::today())
                ->orWhereNull('updated_at');

        })->with(['crawlerItems'])->where('is_active', 0);
        $crawlerTask = $query->first();
        return $crawlerTask;
    }
}

