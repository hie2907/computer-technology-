<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Brand extends Model
{
    protected $collection = 'brands';
    protected $primaryKey = 'brandId';
    protected $fillable = ['brandId', 'brandName', 'categoryId'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'brandId', 'brandId');
    }
}
