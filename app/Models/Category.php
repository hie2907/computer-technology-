<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    protected $collection = 'categories';
    protected $primaryKey = 'categoryId';
    protected $fillable = ['categoryId', 'categoryName'];
    public function brands()
    {
        return $this->hasMany(Brand::class, 'categoryId', 'categoryId');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'categoryId', 'categoryId');
    }
}
