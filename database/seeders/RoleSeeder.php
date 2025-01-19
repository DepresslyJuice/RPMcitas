<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin =Role::create(['name' => 'Administrador']);
        $role2 =Role::create(['name' => 'Secretaria']);
        $role3 =Role::create(['name' => 'Dentista']);



        $permissionAdmin = Permission::create(['name' => 'admin.home']);
        $permissionAdmin = Permission::create(['name' => 'admin.roles.index']);
        $permissionAdmin = Permission::create(['name' => 'admin.roles.create']);
        $permissionAdmin = Permission::create(['name' => 'admin.roles.edit']);
        $permissionAdmin = Permission::create(['name' => 'admin.roles.destroy']);




    }
}
