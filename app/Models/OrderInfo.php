<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class OrderInfo extends Model
{
    protected $table = 'order_info';
    protected $primaryKey = 'order_infoID';
    protected $fillable = [
        'order_infoID',
        'orderID',
        'name',
        'email',
        'location',
        'phone',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID', 'orderID');
    }

}
