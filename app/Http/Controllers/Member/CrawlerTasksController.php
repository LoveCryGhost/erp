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
        $actions = [
            '*',
            'index',
            'show', 'edit','update',
            'create', 'store',
            'destroy',
            'show'];
        $this->coreMiddleware('CrawlerTasksController',$guard='member', $route="crawlerTask", $actions);
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
        return redirect()->route('member.crawlerTask.index')->with('toast', parent::$toast_store);
    }

    public function index()
    {
        $crawlerTasks = $this->crawlerTaskService->index();
        return view(config('theme.member.view').'crawlerTask.index', compact('crawlerTasks'));
    }

    public function edit(CrawlerTask $crawlerTask)
    {
        $this->authorize('update', $crawlerTask);
        return view(config('theme.member.view').'crawlerTask.edit', compact('crawlerTask'));
    }

    public function update(CrawlerTaskRequest $request, CrawlerTask $crawlerTask)
    {
        $this->authorize('update', $crawlerTask);
        $data = $request->all();
        $TF = $this->crawlerTaskService->update($crawlerTask,$data);

        return redirect()->route('member.crawlerTask.index')->with('toast', parent::$toast_update);
    }

    public function destroy(Request $request, CrawlerTask $crawlerTask)
    {
        $this->authorize('destroy', $crawlerTask);
        $data = $request->all();
        $toast = $this->crawlerTaskService->destroy($crawlerTask, $data);
        return redirect()->route('member.crawlerTask.index')->with('toast', parent::$toast_destroy);
    }

    public function refresh()
    {
        //CrawlerTask
        $crawlerTasks = CrawlerTask::where('member_id', Auth::guard('member')->user()->id)
            ->update(['updated_at'=>null]);

        //CrawlerItem 在 Job  中更新

        return redirect()->route('member.crawlerTask.index');
    }
}
