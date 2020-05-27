<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\CrawlerTaskRequest;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerTaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function explode;
use function request;
use function trim;

class CrawlerTasksController extends MemberCoreController
{

    protected $crawlerTaskService;
    public $filters;

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

    public function index()
    {
        $query = $this->crawlerTaskService->crawlertaskRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)
            ->with(['crawlerItems']);

        $this->filters = [
            'ct_name' => request()->ct_name,
            'description' => request()->description,
            'domain_name' => request()->domain_name,
            'id_code' => request()->id_code,
            'locations' => request()->locations,
        ];

        $query = $this->index_filters($query, $this->filters);
        $crawlerTasks = $query->paginate(10);
        return view(config('theme.member.view').'crawlerTask.index', [
                'crawlerTasks' => $crawlerTasks,
                'filters' => $this->filters
            ]);
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

    public function index_filters($query, $filters)
    {
        $query  = $this->filter_like($query,'ct_name', $filters['ct_name']);
        $query  = $this->filter_like($query,'description', $filters['description']);
        $query  = $this->filter_like($query,'domain_name', $filters['domain_name']);
        $query  = $this->filter_like($query,'locations', $filters['locations']);
        $query  = $this->filter_like($query,'id_code', $filters['id_code']);

      return $query;
    }
}
