<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkuTranslation extends CoreModel
{
    protected $table = "sku_translations";
    public $timestamps = false;
    protected $fillable = [ 'sku_name', 'price'];

}
