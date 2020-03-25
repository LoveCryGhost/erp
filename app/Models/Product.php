<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = "products";
    protected $primaryKey='p_id';

    protected $with = [];
    protected $fillable = [
        'publish_at',
        't_id',
        'p_name',
        'c_id', 'p_id',
        'is_active'
    ];


    protected $casts = [
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_categories','p_id','c_id')
            ->withTimestamps();
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function type(){
        return $this->belongsTo(Type::class, 't_id');
    }

    public function productThumbnails(){
        return $this->hasMany(ProductThumbnail::class, 'p_id');
    }

    public function skus($paginate=0){
          return $this->hasMany(SKU::class, 'p_id','p_id')->paginate($paginate);
    }


}
