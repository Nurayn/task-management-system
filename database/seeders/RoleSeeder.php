<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('delete tasks','manage users');
        $user = Role::create(['name' => 'user']);        
        $user->givePermissionTo(['edit tasks', 'create tasks']);
    }
}
