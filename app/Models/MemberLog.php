<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class MemberLog extends Model
{

    protected $table = "member_logs";
    protected $fillable = [
        'ip',
        'login_at',
        'member_id',
        'address',
        'browser',
        'platform',
        'device',
        'device_type',
        'language',
        'user_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'login_at' => 'timestamp',
    ];


}
