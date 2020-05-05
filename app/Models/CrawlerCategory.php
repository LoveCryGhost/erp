<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class CrawlerCategory extends CoreModel
{

    protected $table = "crawler_categories";
    protected $primaryKey = ['catid', 'p_id', 'local'];

    protected $fillable = [
        'catid',
        'p_id',
        'display_name',
        'image',
        'local',
    ];


    protected $hidden = [

    ];

    protected $casts = [
    ];


}
