<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctoresSeeder extends Seeder
{
    public function run()
    {
        DB::table('doctores')->insert([
            [
                'cedula' => '1004077457',
                'nombres' => 'Juan',
                'apellidos' => 'Pérez',
                'telefono' => '0987654321',
                'email' => 'juan.perez@example.com',
            ],
            [
                'cedula' => '1004077458',
                'nombres' => 'María',
                'apellidos' => 'García',
                'telefono' => '0987123456',
                'email' => 'maria.garcia@example.com',
            ],
            [
                'cedula' => '1004077459',
                'nombres' => 'Carlos',
                'apellidos' => 'Estupiñan',
                'telefono' => '0987123456',
                'email' => 'maria.garcia@example.com',
            ],
        ]);
    }
}

