<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent; // Sử dụng model từ Jenssegers
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Eloquent implements AuthenticatableContract
{
    use Authenticatable, HasFactory, Notifiable;

    protected $collection = 'admin'; // Tên collection trong MongoDB
    protected $primaryKey = 'adminID';
    public $timestamps = true;

    protected $fillable = [
        'adminID',
        'adminName',
        'dateofBirth',
        'email',
        'phone',
        'address',
        'password',
        'roleId',
        'dateHired',
        'status',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId', 'roleId');
    }
    public function order(){
        return $this->hasMany(Order::class, 'adminID', 'adminID');
    }
    protected $hidden = [
        'password',
    ];
}
