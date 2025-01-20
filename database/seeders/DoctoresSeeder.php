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
                'cedula' => '1234567890',
                'nombres' => 'Juan',
                'apellidos' => 'Pérez',
                'telefono' => '0987654321',
                'email' => 'juan.perez@example.com',
            ],
            [
                'cedula' => '0987654321',
                'nombres' => 'María',
                'apellidos' => 'García',
                'telefono' => '0987123456',
                'email' => 'maria.garcia@example.com',
            ],
        ]);
    }
}

