<?php

namespace App\Models;

use App\Notifications\MemberResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class Member extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait;

    protected $table = "members";
    protected $with = ['admin'];

    protected $fillable = [
        'id_code', 'is_active', 'name', 'email', 'password',
        'birthday',  'avatar', 'introduction'
    ];


    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday'
    ];

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] =  Carbon::parse($value);
    }


    public function getAvatarAttribute($value)
    {
        if (empty($value)) {
            return '/images/default/avatars/avatar.jpg';
        }
        return $value;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPasswordNotification($token));
    }

    public function admin()
    {
        return $this->belongsTo( Admin::class, 'admin_id','id');
    }

    public function memberLogs()
    {
        return $this->hasMany( MemberLog::class, 'member_id','id');
    }

    //判別是不是作者
    public function isAuthorOf($model)
    {
        return $model->member_id === $this->id;
    }
}
