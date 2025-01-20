<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin')
        ])->assignRole('Administrador');

        User::create([
            'name' => 'secre',
            'email' => 'secre@secre',
            'password' => bcrypt('secre')
        ])->assignRole('Secretaria');

        User::create([
            'name' => 'dentista',
            'email' => 'dentista@dentista',
            'password' => bcrypt('dentista')
        ])->assignRole('Dentista');

        User::create([
            'name' => 'cliente',
            'email' => 'cliente@cliente',
            'password' => bcrypt('cliente')
        ])->assignRole('Cliente');

        User::factory(99)->create();


    }
}
