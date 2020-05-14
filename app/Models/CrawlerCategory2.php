<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CrawlerCategory2 extends CoreModel
{

    protected $table = "crawler_categories";
//    protected $primaryKey = ['catid', 'p_id', 'local'];
    protected $primaryKey = 'catid';
    protected $fillable = [
        'catid',
        'p_id',
        'ct_name',
        'display_name',
        'image',
        'local',
    ];


    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function crawlerTask()
    {
        return $this->hasMany(CrawlerTask::class, 'category')->where('member_id',1);
    }
}
