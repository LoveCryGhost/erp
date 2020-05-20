<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;
use Illuminate\Support\Facades\Auth;
use function request;
use Illuminate\Support\Facades\DB;

class CrawlerItemSKU extends Model
{

    protected $table = "citem_skus";
    //protected $primaryKey='ci_sku_id';

    protected $fillable = [
        'ci_id', 'itemid', 'shopid', 'modelid',
        'name', 'locale', 'sold', 'stock', 'price'
    ];

    //public $with=['sku'];

    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function getPriceAttribute($value)
    {
        return $value/10000;
    }


    public function crawlerItemSKUDetails($records=0)
    {
        $query = $this->hasMany(CrawlerItemSKUDetail::class, 'modelid', 'modelid')
            ->where('shopid', $this->shopid)
            ->where('itemid', $this->itemid)
            ->orderBy('created_at', 'ASC');

        if($records!=0){
            $query = $query->take($records);
        }

        return $query;
    }


    public function NDaysSales($ndays = 30)
    {
        $CrawlerItemSKUs = $this->crawlerItemSKUDetails($ndays)->get();
        $first_day_sale =  $CrawlerItemSKUs->first()->sold;
        $last_day_sale =  $CrawlerItemSKUs->last()->sold;
        return $last_day_sale - $first_day_sale;

    }

    /* 條件
    *  (1) 相同使用者的綁定數據
    *  (2) 不同Task有不同的結果
    */
    public function sku_count_($ct_i_id, $itemid, $shopid, $modelid)
    {
        $crawlerTaskItemSKU =  CrawlerTaskItemSKU::where([
                'ct_i_id' => $ct_i_id,
                'itemid' => $itemid,
                'shopid' => $shopid,
                'modelid' => $modelid
            ])
            ->join('crawler_tasks', function($join)
            {
                $join->on('crawler_tasks.ct_id', '=', 'psku_cskus.ct_i_id')
                    ->where('crawler_tasks.member_id', Auth::guard('member')->user()->id);
            })
            ->count();

        return $crawlerTaskItemSKU;
        //return $this->belongsToMany(SKU::class, 'psku_cskus', 'modelid', 'sku_id');
        //return 123;
    }

    /* 條件
   *  (1) 相同使用者的綁定數據
   *  (2) 不同Task有不同的結果
   */
    public function sku_count()
    {
        $ct_i_ids =  CrawlerTaskItemSKU::where([
            'itemid' => $this->itemid,
            'shopid' => $this->shopid,
            'modelid' => $this->modelid
        ])->pluck('ct_i_id');

        $qty = CrawlerTask::where('member_id', Auth::guard('member')->user()->id)
                            ->join('ctasks_items', function($join) use($ct_i_ids)
                            {
                                $join->on('ctasks_items.ct_id', '=', 'crawler_tasks.ct_id')
                                    ->whereIn('ctasks_items.ct_i_id', $ct_i_ids);
                            })->count();
        return ($qty);
    }
}
