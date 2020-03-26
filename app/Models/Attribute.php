<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = "attributes";
    protected $primaryKey='a_id';

    protected $fillable = [
        'is_active', 'a_name', 'a_description',
    ];

    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }

    public function type(){
        return $this->belongsTo(Type::class, 't_id');
    }
}
