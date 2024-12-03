<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'orderID';
    protected $fillable = [
        'orderID',
        'userID',
        'adminID',
        'order_Date',
        'total_Amount',
        'order_Status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
     public function admin()
    {
        return $this->belongsTo(Admin::class, 'adminID', 'adminID');
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'orderID', 'orderID');
    }
    public function orderInfo()
    {
        return $this->hasOne(OrderInfo::class, 'orderID', 'orderID');
    }
}
