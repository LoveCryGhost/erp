<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class CrawlerTask extends Model
{

    protected $table = "crawler_tasks";
    protected $primaryKey='ct_id';

    protected $fillable = [
        'is_active', 'sort_order',
        'ct_name', 'url', 'domain_name','pages', 'local',
        'category',
        'subcategory',
        'sort_by',
        'keyword',
        'order',
        'locations',
        'ratingFilter',
        'facet',
        'shippingOptions',
        'wholesale',
        'officialMall',
        'description'
    ];

    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }

    public function crawlerItems(){
        return $this->belongsToMany(CrawlerItem::class, 'ctasks_items','ct_id','ci_id')
            ->withPivot(['sort_order']);
    }
}
