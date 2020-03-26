<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class Staff extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait;

    protected $table = "staffs";
    protected $primaryKey='id';

    protected $with=['staffDepartments'];

    protected $fillable = [
        'id_code', 'pic', 'password',
        'staff_code', 'is_active', 'is_block',

        'name', 'sex', 'identify_code',
        'avatar',

        'birthday',

        'interview_at', 'join_at', 'social_security_at',
        'apply_for_leave_at', 'leave_at',

        'email',

        'tel1', 'phone1', 'address_fix',
        'tel2', 'phone2', 'address_current',

        'note',

        'introduced_by', 'interviewed_by',

        //學歷
        'education1_from', 'education1_to', 'education1_level', 'school1_name',
        'education2_from', 'education2_to', 'education2_level', 'school2_name',

        //經歷
        'experience1_from', 'experience1_to', 'company1_name',
        'experience2_from', 'experience2_to', 'company2_name',

        //聯繫人
        'contact1', 'contact_tel1', 'contact_phone1',
        'contact2', 'contact_tel2', 'contact_phone2',

        //dorm
        'dorm_number',

        'photo_id1', 'photo_id2', 'medical_check',

        'level',

        //國家
        'local',

    ];

    protected $dates = [
        'birthday',
        'interview_at',
        'join_at',
        'social_security_at',
        'apply_for_leave_at',
        'leave_at',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function staffDepartments()
    {
        return $this->belongsToMany(StaffDepartment::class, 'staffs_departments','st_id','d_id')
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

    public function staffLogs()
    {
        return $this->hasMany( StaffLog::class, 'staff_id','id');
    }

    //判別是不是作者
    public function isAuthorOf($model)
    {
        return $model->staff_id === $this->id;
    }
}
