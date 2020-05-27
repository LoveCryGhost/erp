<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKUAttributeTranslation extends CoreModel
{

    protected $table = "sku_attribute_translations";
    public $timestamps = false;
    protected $fillable = ['a_value'];

}
