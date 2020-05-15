<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesSupplier extends Model
{
    protected $table = "mh_shoes_suppliers";
    protected $primaryKey='s_id';

    protected $fillable = [
        'supplier_name',
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
