<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class SupplierGroup extends Model
{
    use Translatable;
    protected $table = "supplier_groups";

    protected $primaryKey='sg_id';

    protected $with = [];

    protected $fillable = ['is_active'];

    public $translatedAttributes = [
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
        'kg_price'
    ];



    protected $casts = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
