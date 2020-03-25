<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierGroup extends Model
{
    protected $table = "supplier_groups";

    protected $primaryKey='sg_id';

    protected $with = [];

    protected $fillable = [
        'is_active', 'sg_name', "name_card", "add_company", "wh_company",
        "tel", "phone", "company_id", "website", 'introduction'
    ];

    protected $casts = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
