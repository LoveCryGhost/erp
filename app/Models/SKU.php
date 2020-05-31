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
        'sort_order',
        'p_id', 'thumbnail', 'is_active',
        'length_pcs',
        'width_pcs',
        'heigth_pcs',
        'weight_pcs',
        'length_box',
        'width_box',
        'heigth_box',
        'weight_box',
        'pcs_per_box',
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
            ->using(SKUSupplier::class)
            ->withPivot(['ss_id', 'is_active', 'sort_order', 'url', 's_id', 'random', 'created_at', 'updated_at'])
            ->orderBy('sort_order','ASC')
            ->withTimestamps();
    }

    public function crawlerTaskItemSKU()
    {
        //須去除重複值
        return $this->hasMany(CrawlerTaskItemSKU::class, 'sku_id')->groupBy(['itemid','shopid', 'modelid']);

//            ->leftJoin('ctasks_items', function ($join) {
//                $join->on('ctasks_items.ct_i_id', '=', 'psku_cskus.ct_i_id');
//            })

//            ->leftJoin('crawler_tasks', function ($join) {
//                $join->on('crawler_tasks.ct_id', '=', 'ctasks_items.ct_id')
//                    ->where('crawler_tasks.member_id', Auth::guard('member')->user()->id);
//            });
    }
}
