<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesCustomer extends Model
{
    protected $table = "mh_shoes_customers";
    protected $primaryKey='c_id';

    protected $fillable = [
        'c_name',
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
