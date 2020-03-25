<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class CrawlerItemSKUDetail extends Model
{

    protected $table = "citem_sku_details";
    public $incrementing = false;
    public $primaryKey=null;
    //protected $primaryKey=['shopid', 'itemid', 'modelid'];

    protected $fillable = [
        'itemid', 'shopid', 'modelid',
        'price', 'price_before_discount', 'sold', 'stock'
    ];

    protected $hidden = [

    ];

    protected $casts = [
    ];


}
