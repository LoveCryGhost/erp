<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesMaterial extends Model
{
    protected $table = "mh_shoes_materials";
    protected $primaryKey='mt_id';

    protected $fillable = [
        'material_code',
        'material_name',
        'material_unit',
        'material_price',
        's_id',
        'supplier_name',

        'mt_id',
        'material_name'
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
