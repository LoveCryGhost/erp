<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesMaterialUsage extends Model
{
    protected $table = "mh_material_usages";
    protected $primaryKey='id';

    protected $fillable = [
        'model',
        'size',
        'usage',
        'staff_id',
        'pair_per_unit'
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
