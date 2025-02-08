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

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.roles.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.destroy'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.doctores.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctores.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctores.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctores.destroy'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.especialidades.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.especialidades.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.especialidades.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.especialidades.destroy'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.consultorios.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.consultorios.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.consultorios.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.consultorios.destroy'])->syncRoles([$admin]);

        Permission::create(['name' => 'pacientes'])->syncRoles([$admin, $secretaria]);



        Permission::create(['name' => 'admin.auditoria'])->syncRoles([$admin]);

        
    }
}
