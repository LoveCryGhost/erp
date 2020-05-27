<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends CoreModel
{
    protected $table = "product_translations";
    public $timestamps = false;
    protected $fillable = [ 'p_name', 'p_description', 'tax_percentage', 'custom_code'];

}
