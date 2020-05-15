<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesOrder extends Model
{
    protected $table = "mh_shoes_orders";
    protected $primaryKey='order_id';
    public $timestamps = false;
    protected $fillable = [
        'mh_order_code',
        'predict_at',
        'department',
        'received_at',
        'outbound_condition',
        'c_purchase_code',
        'order_condition',
        'c_order_code',
        'c_id',
        'c_name',
        'm_id',
        'model_name',
        'puchase_plan',
        'purchase_content',
        'material_code',
        'material_name',
        'material_unit',
        'order_type',

        'color',
        'currency',
        'price',
        'qty',
        'inbound_qyt',
        'inbound_at',
        'outbound_at',
        'pic',
        'note'
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];

    public function shoesOrderDetails()
    {
        return $this->hasMany(ShoesOrderDetail::class, 'mh_order_code', 'mh_order_code');
    }

    public function shoesPurchases()
    {
        return $this->hasMany(ShoesPurchase::class, 'order_id', 'order_id');
    }

    public function shoesCustomer()
    {
        return $this->belongsTo(ShoesCustomer::class, 'c_id', 'c_id');
    }




}
