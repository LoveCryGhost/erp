<?php

namespace App\Models\Shoes;
use App\Models\StaffDepartment;
use Illuminate\Database\Eloquent\Model;

class ShoesMold extends Model
{
    protected $table = "mh_shoes_molds";
    protected $primaryKey='mold_id';

    protected $fillable = [
        'department_id',
        'proccess_order',
        'proccess',
        'mold_type',
        'keep_vendor',
        'm_id',
        'size',
        'series',
        'vendor',
        'qty',
        'pairs',
        'operation_time',
        'cycle_time',
        'condition',
    ];


    protected $hidden = [
    ];

    protected $casts = [

    ];

    public function department()
    {
        return $this->belongsTo(StaffDepartment::class, 'department_id');
    }


}
