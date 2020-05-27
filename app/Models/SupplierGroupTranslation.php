<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierGroupTranslation extends CoreModel
{
    protected $table = "supplier_group_translations";
    public $timestamps = false;
    protected $fillable = [
        'sg_name',
        'name_card',
        'add_company',
        'wh_company',
        'tel',
        'phone',
        'company_id',
        'website',
        'introduction',
        'cbm_price',
        'kg_price',
];

}
