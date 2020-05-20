<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends CoreModel
{
    protected $table = "type_translations";
    public $timestamps = false;
    protected $fillable = [ 't_name', 't_description'];

}
