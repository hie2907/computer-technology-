<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
    protected $collection = 'roles';
    protected $primaryKey = 'roleId';
    public $timestamps = true;

    protected $fillable = [
        'roleId',
        'roleName',
    ];

    public function users()
    {
        return $this->hasMany(Admin::class, 'roleId', 'roleId');
    }
}
