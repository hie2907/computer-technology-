<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;

class User extends Eloquent implements AuthenticatableContract
{
    use Authenticatable, HasFactory, Notifiable;
    protected $collection = 'users';
    protected $primaryKey = 'userID';
    public $timestamps = true;

    protected $fillable = ['userID','userName', 'email', 'phone', 'adress','password', 'dateRegister'];
    protected $hidden = ['password'];
    public function order()
    {
        return $this->hasMany(Order::class, 'userID', 'userID');
    }
}
