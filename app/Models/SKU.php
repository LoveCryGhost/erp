<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{

    protected $table = "skus";
    protected $primaryKey='sku_id';

    protected $with = ['skuAttributes','skuSuppliers'];
    protected $fillable = [
        'p_id', 'sku_name', 'thumbnail', 'price', 'is_active'
    ];

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
}
