<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class CartItems extends Model
{
    protected $collection = 'cart_items';
    protected $primaryKey = 'cartItemId';
    protected $fillable = ['cartItemId','productId','cartId', 'quantity'];
    public function products()
    {
        return $this->belongsTo(Product::class, 'productId', 'productId');
    }
}
