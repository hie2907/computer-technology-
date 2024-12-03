<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'order_detailID';
    protected $fillable = ['order_detailID','productId', 'orderID', 'quantity', 'price_Purchase','note'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID', 'orderID');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'productId');
    }
}
