<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesOrder extends Model
{
    protected $table = "mh_shoes_orders";
    protected $primaryKey='order_id';

    protected $fillable = [
        'mh_order_code',
        'department',
        'received_at',
        'outbound_condition',
        'c_purhcase_code',
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
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
