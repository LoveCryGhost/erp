<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CrawlerItem extends CoreModel
{

    protected $table = "crawler_items";
    protected $primaryKey = 'ci_id';

    protected $fillable = [
        'is_active',
        'itemid', 'shopid',
        'name',
        'images', 'sold', 'historical_sold', 'locale', 'domain_name'
    ];


    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }

    public function crawlerItemSKUs(){
        return $this->hasMany(CrawlerItemSKU::class, 'ci_id', 'ci_id');
    }


    public function crawlerTask()
    {
        return $this->belongsToMany(CrawlerTask::class, 'ctasks_items','ci_id','ct_id')
            ->withPivot(['ct_i_id','sort_order', 'is_active']);
    }

    public function crawlerTasks()
    {
        return $this->belongsToMany(CrawlerTask::class, 'ctasks_items','ci_id','ct_id')
            ->withPivot(['ct_i_id','sort_order', 'is_active']);
    }

    public function crawlerShop()
    {
        return $this->hasOne(CrawlerShop::class, 'shopid', 'shopid');
    }
}
