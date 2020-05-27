<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class SKUAttribute extends CoreModel implements TranslatableContract
{
    use Translatable;
    protected $table = "sku_attributes";
    protected $primaryKey='sa_id';

    protected $with = [];
    protected $fillable = [
        'sku_id', 'a_id'
    ];

    public $translatedAttributes = ['a_value'];
    protected $casts = [

    ];

    public function attribute()
    {
        return $this->hasOne(Attribute::class, 'a_id', 'a_id');
    }
}
