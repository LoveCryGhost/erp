<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class SKUSupplier extends Pivot implements TranslatableContract
{

    use Translatable;
    public $incrementing = true;

    protected $table = "skus_suppliers";
    protected $primaryKey='ss_id';
    protected $fillable = [
        'ss_id', 'is_active', 'sort_order', 'url', 's_id'
    ];

    public $translatedAttributes = ['price'];


}
