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
}
