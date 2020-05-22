<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrawlerTaskItemSKU extends Model
{

    protected $table = "psku_cskus";
    protected $primaryKey = 'pc_sku_id';

    protected $fillable = [
        'sku_id',
        'ct_i_id',
        'itemid',
        'shopid',
        'modelid',
        'member_id'
    ];

    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function sku()
    {
        return $this->belongsTo(SKU::class, 'sku_id');
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

}
