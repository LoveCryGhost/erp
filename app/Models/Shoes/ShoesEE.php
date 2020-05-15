<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesEE extends Model
{
    protected $table = "mh_shoes_ee";
    protected $primaryKey='id';

    protected $fillable = [
        'mh_order_code',
        'received_at',
        'outbound_condition',
        'm_purchase_code',
        'order_condition',
        'c_name',
        'c_order_code',
        'model_name',
        'puchase_plan',
        'purchase_content',
        'material_code',
        'material_name',
        'material_unit',
        'order_type',
        'bom_type',
        'purchase_a_qty',
        'purchase_loss_qty',
        'purchase_plan_qty',
        'purchase_at',
        'purchase_qty',
        'material_received_at',
        'inbound_qty',
        'particle_qty',
        'outbount_at',
        'material_a_outbound_qty',
        'material_o_outbound_qty',
        'material_fass_outbound_qty',
        'material_reprocess_outbound_qty',
        'supplier_name',
        'material_price',
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
