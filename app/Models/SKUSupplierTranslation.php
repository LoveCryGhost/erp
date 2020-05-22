<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKUSupplierTranslation extends CoreModel
{
    protected $table = "sku_supplier_translations";
    public $timestamps = false;
    protected $fillable = [ 'price'];

}
