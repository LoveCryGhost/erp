<?php

namespace App\Http\Controllers\Member;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrawlerItemsController extends MemberCoreController
{
    /**
     * @var CrawlerItemService
     */
    private $crawlerService;

    public function __construct(CrawlerItemService $crawlerItemService)
    {
        $this->middleware('auth:member');
        $this->crawlerService = $crawlerItemService;
    }

    public function index()
    {
        $crawlerTask = $this->crawlerService->crawlerTaskRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)->find(request()->crawlerTask);
        $this->authorize('index', new CrawlerItem());

        $crawlerItems = $crawlerTask->crawlerItems()
            ->where('is_active', request()->is_active)
            ->with('crawlerItemSKUs')
            ->orderBy('ctasks_items.sort_order')
            ->paginate(50);
        return view(config('theme.member.view').'crawlerItem.index',
            [
                'crawlerTask' => $crawlerTask,
                'crawlerItems' => $crawlerItems,
                'filters' => [
                    'crawlerTask'  => $crawlerTask->ct_id,
                    'is_active' => request()->is_active
                ]
            ]);
    }

    public function toggle(Request $request){
        $crawlerItem = $this->crawlerService->crawlerItemRepo->getById($request->ci_id);
        if($crawlerItem->is_active==1){
            $crawlerItem->is_active=0;
        }else{
            $crawlerItem->is_active=1;
        }
        $crawlerItem->save();
    }

    public function save_cralwertask_info()
    {
        $crawlerTask = $this->crawlerService->crawlerTaskRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)->find(request()->crawlerTask);
        if($crawlerTask) {
            $crawlerTask->description = request()->description;
            $crawlerTask->save();
        }

        return redirect()->route('member.crawleritem.index',['crawlerTask'=>request()->crawlerTask, 'is_active'=> request()->is_active]);

    }
}
