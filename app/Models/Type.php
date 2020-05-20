<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Type extends CoreModel
{

    use Translatable;
    protected $table = "types";
    protected $primaryKey='t_id';

    protected $fillable = [
        'is_active',
    ];
    public $translatedAttributes = ['t_name', 't_description'];

    protected $hidden = [

    ];

    protected $casts = [
    ];


    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'types_attributes','t_id','a_id')
            ->orderBy('sort_order')
            ->withPivot(['sort_order'])
            ->withTimestamps();
    }

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}
