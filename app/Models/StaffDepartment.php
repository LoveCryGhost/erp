<?php

namespace App\Models;

use Carbon\Carbon;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class StaffDepartment extends Authenticatable implements MustVerifyEmailContract
{

    protected $table = "staff_departments";
    protected $primaryKey='d_id';

    protected $fillable = [
        'parent_id', 'sort_order', 'is_active',
        'id_code', 'name', 'description', 'local'
    ];

    public $with =['parent'];

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'staffs_departments','d_id','st_id')
            ->withPivot(['sd_id', 'st_id', 'd_id', 'created_by', 'modified_by', 'start_at', 'bonus', 'note'])
            ->withTimestamps();
    }

    public function modified_by()
    {
        return $this->belongsToMany(Staff::class, 'staffs_departments','st_id','modified_by');
    }

    public function created_by()
    {
        return $this->belongsToMany(Staff::class, 'staffs_departments','st_id','created_by');
    }

    public function parent()
    {
        return $this->belongsTo(StaffDepartment::class, 'parent_id', 'd_id');
    }

    public function children()
    {
        return $this->hasMany(StaffDepartment::class, 'parent_id');
    }


}
