<?php

namespace App\Models;


class StaffExcelLike extends CoreModel
{

    protected $table = "staff_excel_likes";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_code',
        'pic',
        'is_active',
        'showable',
        'editable',
        'title',
        'description',
        'excel_content',
        'jquery',
    ];


    protected $hidden = [

    ];

    protected $casts = [
        'excel_content' => 'array'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'pic', 'id')->without(['staffDepartments']);
    }
}
