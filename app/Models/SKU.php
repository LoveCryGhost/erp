<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SKU extends Model
{

    use Translatable;
    protected $table = "skus";
    protected $primaryKey='sku_id';

    protected $with = ['skuAttributes','skuSuppliers'];
    protected $fillable = [
        'p_id', 'thumbnail', 'is_active'
    ];

    public $translatedAttributes = ['sku_name', 'price'];

    protected $casts = [

    ];

    public function product(){
        return $this->belongsTo(Product::class, 'p_id');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function skuAttributes()
    {
        return $this->hasMany(SKUAttribute::class, 'sku_id');
    }

    public function skuSuppliers()
    {
        return $this->belongsToMany(Supplier::class, 'skus_suppliers','sku_id','s_id')
            ->withPivot(['ss_id', 'is_active', 'sort_order', 'price', 'url', 's_id'])
            ->withTimestamps();
    }

    public function crawlerTaskItemSKU()
    {
        //須去除重複值
        return $this->hasMany(CrawlerTaskItemSKU::class, 'sku_id')
            ->join('ctasks_items', function ($join) {
                $join->on('ctasks_items.ct_i_id', '=', 'psku_cskus.ct_i_id');
            })
            ->join('crawler_tasks', function ($join) {
                $join->on('crawler_tasks.ct_id', '=', 'ctasks_items.ct_id')
                    ->where('crawler_tasks.member_id', Auth::guard('member')->user()->id);
            });
    }
}
