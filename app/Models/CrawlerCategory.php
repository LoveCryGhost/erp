<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CrawlerCategory extends CoreModel
{

    protected $table = "crawler_categories";
    protected $primaryKey = ['catid', 'p_id', 'local'];
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
}