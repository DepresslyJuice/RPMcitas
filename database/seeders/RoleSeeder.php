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
        $admin = Role::create(['name' => 'Administrador']);
        $secretaria = Role::create(['name' => 'Secretaria']);
        $dentista = Role::create(['name' => 'Dentista']);
        $cliente = Role::create(['name' => 'Cliente']);

        Permission::create(['name' => 'admin.home'])->syncRoles([$admin, $secretaria, $dentista]);

        Permission::create(['name' => 'admin.admin'])->syncRoles([$admin]);

        // Permisos para la gestión de pacientes
        Permission::create(['name' => 'pacientes'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'dentista.pacientes'])->syncRoles([$dentista]);


        // Permisos para la gestión de citas médicas
        Permission::create(['name' => 'citas'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'dentista.citas'])->syncRoles([$dentista]);


        Permission::create(['name' => 'admin.auditoria'])->syncRoles([$admin]);
    }
}
