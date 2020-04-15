<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesPurchase extends Model
{
    protected $table = "mh_shoes_purchases";
    protected $primaryKey='p_id';

    protected $fillable = [
        'order_id',
        'mt_id',
        'puchase_plan',
        'purchase_content',
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
        'material_price',
        's_id',
        'supplier_name',
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
