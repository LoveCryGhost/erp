<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
    protected $table = "attribute_translations";
    public $timestamps = false;
    protected $fillable = [ 'a_name', 'a_description'];
}
