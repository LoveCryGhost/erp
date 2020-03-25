<?php

namespace App\Policies;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrawlerItemPolicy
{
    use HandlesAuthorization;

    /*
     * 两个参数，
     * 第一个参数默认为当前登录用户实例，
     * 第二个参数则为要进行授权的用户实例
     * */
    public function index(Member $member, CrawlerItem $crawlerItem)
    {
        $crawlerTask =CrawlerTask::find(request()->crawlerTask);
        return $member->isAuthorOf($crawlerTask);
    }
}
