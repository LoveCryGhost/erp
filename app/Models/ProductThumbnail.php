<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductThumbnail extends Model
{

    protected $table = "product_thumbnails";
    protected $primaryKey='pt_id';

    protected $fillable = [
        'p_id',
        'sort_order',
        'path',
    ];
}
