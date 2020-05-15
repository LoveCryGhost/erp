<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesOrderDetail extends Model
{
    protected $table = "mh_shoes_order_details";
    public $timestamps = false;
    protected $fillable = [
        'mh_order_code',
        'size',
        'p_l_r',
        'qty',
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
