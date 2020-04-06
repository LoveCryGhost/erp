<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderCartItem extends CoreModel
{

    protected $table = "purchase_order_cart_items";
    protected $primaryKey='poci_id';
    public $timestamps = false;

    protected $fillable = ['amount'];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function sku()
    {
        return $this->belongsTo(SKU::class, 'sku_id');
    }
}
