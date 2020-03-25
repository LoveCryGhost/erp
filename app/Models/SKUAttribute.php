<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKUAttribute extends Model
{

    protected $table = "sku_attributes";
    protected $primaryKey='sa_id';

    protected $with = [];
    protected $fillable = [
        'sku_id', 'a_id', 'a_value'
    ];

    protected $casts = [

    ];

    public function attribute()
    {
        return $this->hasOne(Attribute::class, 'a_id', 'a_id');
    }
}
