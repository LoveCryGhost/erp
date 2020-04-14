<?php

namespace App\Models\Shoes;
use Illuminate\Database\Eloquent\Model;

class ShoesModel extends Model
{
    protected $table = "mh_shoes_models";
    protected $primaryKey='m_id';

    protected $fillable = [
        'model_name', 'department'
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];


}
