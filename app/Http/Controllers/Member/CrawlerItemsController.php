<?php

namespace App\Http\Controllers\Member;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->wherePivot('is_active', request()->is_active)
            ->with(['crawlerItemSKUs','crawlerShop'])
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

        $data = $request->all();

        $ci_id = $data['ci_id'];
        $crawlerItem = CrawlerItem::find($ci_id);
        $pivot = $crawlerItem->crawlerTask()->wherePivot('ct_i_id', $data['ct_i_id'])->first()->pivot;


        if($pivot->is_active==1){
            DB::table('ctasks_items')->where('ct_i_id', $data['ct_i_id'])->update(['is_active'=>0]);
        }else{
            DB::table('ctasks_items')->where('ct_i_id', $data['ct_i_id'])->update(['is_active'=>1]);
        }
    }

    public function saveCralwerTaskInfo()
    {
        $crawlerTask = $this->crawlerService->crawlerTaskRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)->find(request()->crawlerTask);
        if($crawlerTask) {
            $crawlerTask->description = request()->description;
            $crawlerTask->save();
        }

        return redirect()->route('member.crawlerItem.index',['crawlerTask'=>request()->crawlerTask, 'is_active'=> request()->is_active])
            ->with('toast', parent::$toast_update);

    }
}
