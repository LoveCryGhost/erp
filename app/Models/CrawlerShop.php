<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class CrawlerShop extends Model
{

    protected $table = "crawler_shops";
    protected $primaryKey='cs_id';

    protected $fillable = [
        'shopid',
        'username',
        'sold', 'historical_sold', 'shop_location',
        'domain_name', 'local',
    ];

    protected $hidden = [

    ];

    protected $casts = [
    ];



    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}
