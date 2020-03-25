<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\CrawlerTaskRequest;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerTaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CrawlerTasksController extends MemberCoreController
{

    protected $crawlerTaskService;

    public function __construct(CrawlerTaskService $crawlerTaskService)
    {
        $this->middleware('auth:member');
        $this->crawlerTaskService = $crawlerTaskService;
    }

    public function create()
    {
        return view(config('theme.member.view').'crawlerTask.create');
    }

    public function store(CrawlerTaskRequest $request)
    {
        $data = $request->all();
        $crawlerTask = $this->crawlerTaskService->store($data);
        return redirect()->route('member.crawlertask.index')->with('toast', parent::$toast_store);
    }

    public function index()
    {
        $crawlerTasks = $this->crawlerTaskService->index();
        return view(config('theme.member.view').'crawlerTask.index', compact('crawlerTasks'));
    }

    public function edit(CrawlerTask $crawlertask)
    {
        $this->authorize('update', $crawlertask);
        return view(config('theme.member.view').'crawlerTask.edit', compact('crawlertask'));
    }

    public function update(CrawlerTaskRequest $request, CrawlerTask $crawlertask)
    {
        $this->authorize('update', $crawlertask);
        $data = $request->all();
        $TF = $this->crawlerTaskService->update($crawlertask,$data);

        return redirect()->route('member.crawlertask.index')->with('toast', parent::$toast_update);
    }

    public function destroy(Request $request, CrawlerTask $crawlertask)
    {
        $this->authorize('destroy', $crawlertask);
        $data = $request->all();
        $toast = $this->crawlerTaskService->destroy($crawlertask, $data);
        return redirect()->route('member.crawlertask.index')->with('toast', parent::$toast_destroy);
    }

    public function refresh()
    {
        //CrawlerTask
        $crawlerTasks = CrawlerTask::where('member_id', Auth::guard('member')->user()->id)
            ->update(['updated_at'=>null]);

        //CrawlerItem 在 Job  中更新

        return redirect()->route('member.crawlertask.index');
    }
}
