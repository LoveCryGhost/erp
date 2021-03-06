<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Jobs\CrawlerSubCategoryJob;
use App\Jobs\TaskItemToMemberJob;
use App\Models\CrawlerTask;
use App\Models\Member;
use App\Repositories\Member\CrawlerTaskRepository;
use Illuminate\Support\Facades\DB;
use function dispatch;
use function ini_set;
use function redirect;
use function set_time_limit;

class RunController extends AdminCoreController
{

    public function __construct()
    {
        ini_set('memory_limit', -1);
        set_time_limit(0);
    }

    public function taskToMember()
    {

        //將Task 拷貝到Member
        $Tasks_member_ids = ['2','3','4','5'];
        //$Tasks_member_ids = ['2','3'];
        $members = [ 'andy@app.com','risca@app.com', 'cris@app.com'];
        //$members = [ 'andy@app.com'];



        foreach($members as $member_email){
            $member =  Member::where('email', $member_email)->first();
            $crawlerTasks = CrawlerTask::whereIn('member_id',$Tasks_member_ids)->get();
            foreach($crawlerTasks as $crawlerTask){

                CrawlerTask::updateOrCreate([
                        'member_id' =>  $member->id,
                        'category' => $crawlerTask->category,
                        'subcategory' => $crawlerTask->subcategory,
                        'domain_name' => $crawlerTask->domain_name,
                        'locale' => $crawlerTask->locale,
                        'sort_by' => $crawlerTask->sort_by,
                        'locations' => $crawlerTask->locations,
                    ],[

                        'is_active' => 0,
                        'url' => $crawlerTask->url,
                        'website' => $crawlerTask->website,
                        'ct_name' => $crawlerTask->ct_name,
                        'pages' => $crawlerTask->pages,
                        'is_crawler' => 0,
                        'current_page' => $crawlerTask->current_page,
                    ]);
            }
        }
    }

    public function taskItemToMemberRefresh()
    {
//        $crawlerTasks = CrawlerTask::whereIn('member_id', [6,7,8])->where('is_active',0)->get();
//
//        foreach ($crawlerTasks as $crawlerTask){
//            $crawlerTask->crawlerItems()->detach();
//        }

        $crawlerTasks = CrawlerTask::whereIn('member_id', [6,7,8])->where('is_active',0)->update(
            [
                'updated_at' => null,
                'is_crawler' => 1
            ]
        );

        return redirect()->back();
    }

    public function taskItemToMember()
    {
        dispatch((new TaskItemToMemberJob())->onQueue('instant'));
        return redirect()->back();
    }

    public function deleteDuplicateCtaskCitem()
    {
        $sql = 'DELETE FROM ctasks_items WHERE ct_i_id NOT IN (SELECT * FROM (SELECT MIN(n.ct_i_id) FROM ctasks_items n GROUP BY n.ct_id, n.ci_id) x)';
        $results = DB::select( DB::raw($sql) );
        return redirect()->back();
    }

}
