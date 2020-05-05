<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminMemberRequest;
use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Models\Member;
use App\Services\Member\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**

 */
class AdminCrawlerItemsController extends AdminCoreController
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
        $query = CrawlerItem::with(['crawlerTasks']);
        $crawlerItem_total = $query->count();
        $crawlerItems = $query->paginate(50);
        return view(config('theme.admin.view').'adminCrawlerItem.index',[
            'crawlerItems' => $crawlerItems,
            'crawlerItem_total' => $crawlerItem_total,
            'filters' => []
        ]);
    }
}
