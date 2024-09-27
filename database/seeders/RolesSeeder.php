<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $role1 = Role::create(['name' => 'administrador']);

        $user = User::find(1);
        $user->assignRole($role1);
    }
}