<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $collection = 'products';
    protected $primaryKey = 'productId';
    protected $fillable = [
        'productId',
        'productName',
        'description',
        'price',
        'stockQuantity',
        'images' ,
        'categoryId',
        'brandId',
        'dateAdded',
    ];
    protected $casts = [
        'images' => 'array', // Đảm bảo rằng images là mảng
    ];
    public function cartitem()
    {
        return $this->hasMany(CartItems::class, 'productId', 'productId');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'brandId','brandId');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }
    public function orderDetail()
    {
        return $this->hasMany(CartItems::class, 'productId', 'productId');
    }
}
