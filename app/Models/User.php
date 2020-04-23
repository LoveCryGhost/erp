<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait;
    use HasRoles;

    protected $table = "users";
    protected $fillable = [
        'name', 'email', 'password',
        'birthday', 'is_active', 'avatar', 'introduction'
    ];

    protected $hidden = [
        'password', 'remember_token',
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

    public function member()
    {
        return $this->belongsTo( Member::class, 'member_id','id');
    }

    public function UserLogs()
    {
        return $this->hasMany( UserLog::class, 'user_id','id');
    }

    //判別是不是作者
    public function isAuthorOf($model)
    {
        return $model->user_id === $this->id;
    }
}
