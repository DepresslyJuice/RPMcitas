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
            'cedula' => '1728185230',
            'password' => bcrypt('admin')
        ])->assignRole('Administrador');

        User::create([
            'name' => 'secre',
            'email' => 'secre@secre',
            'cedula' => '1005142144',
            'password' => bcrypt('secre')
        ])->assignRole('Secretaria');

        User::create([
            'name' => 'dentista',
            'email' => 'dentista@dentista',
            'cedula' => '1004077457',	
            'password' => bcrypt('dentista')
        ])->assignRole('Dentista');


        User::create([
            'name' => 'dentista',
            'email' => 'dentista2@dentista',
            'cedula' => '1004077458',	
            'password' => bcrypt('dentista')
        ])->assignRole('Dentista');

        User::create([
            'name' => 'dentista',
            'email' => 'dentista3@dentista',
            'cedula' => '1004077459',	
            'password' => bcrypt('dentista')
        ])->assignRole('Dentista');

        User::create([
            'name' => 'dentista',
            'email' => 'ddamiandelacruzc117@gmail.com',
            'cedula' => '0401844824',	
            'password' => bcrypt('damian123')
        ])->assignRole('Administrador');
        
        User::factory(20)->create();


    }
}
