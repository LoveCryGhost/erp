<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminMemberRequest;
use App\Models\CrawlerTask;
use App\Models\Member;
use App\Services\Member\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**

 */
class AdminCrawlerTasksController extends AdminCoreController
{
    protected $memberService;
    public function __construct(MemberService $memberService)
    {
//        $actions = [
//            'index',
//            'show', 'edit','update',
//            'create', 'store',
//            'destroy',
//            'show',
//            'updatePassword'];
//        $this->coreMiddleware('AdminMembersController',$guard='admin', $route="adminMember", $actions);

        $this->memberService = $memberService;
    }

    public function index(){
        $query = CrawlerTask::with(['member']);
        $crawlerTask_total = $query->count();

        $crawlerTasks = $query->paginate(10);
        return view(config('theme.admin.view').'adminCrawlerTask.index',[
            'crawlerTasks' => $crawlerTasks,
            'crawlerTask_total' => $crawlerTask_total,
            'filters' => []
        ]);
    }
}
