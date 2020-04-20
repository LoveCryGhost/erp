<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesDB extends Model
{
    protected $table = "mh_shoes_db";
    protected $primaryKey='id';

    protected $fillable = [
        'mh_order_code',
        'customer_name',
        'c_purchase_code',
        'c_order_code',
        'c_order_code',
        'model_name',
        'qty',
        'color',
        'received_at',
        'sizes',
        'note',
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'sizes' => 'array'
    ];


}
