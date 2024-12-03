<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['roleId' => 1, 'roleName' => 'admin']);
        Role::create(['roleId' => 2, 'roleName' => 'employee']);
        Role::create(['roleId' => 3, 'roleName' => 'shipper']);
    }
}
