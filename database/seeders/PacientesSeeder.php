<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacientesSeeder extends Seeder
{
    public function run()
    {
        DB::table('pacientes')->insert([
            [
                'cedula' => '1122334455',
                'nombres' => 'Carlos',
                'apellidos' => 'Ramírez',
                'telefono' => '0991234567',
                'fecha_nacimiento' => '1990-01-15',
            ],
            [
                'cedula' => '2233445566',
                'nombres' => 'Ana',
                'apellidos' => 'López',
                'telefono' => '0986543210',
                'fecha_nacimiento' => '1985-05-20',
            ],
            [
                'cedula' => '3344556677',
                'nombres' => 'Melany',
                'apellidos' => 'Farinango',
                'telefono' => '0986543211',
                'fecha_nacimiento' => '1999-05-20',
            ],

            [
                'cedula' => '4455667788',
                'nombres' => 'Marcelo',
                'apellidos' => 'Ponce',
                'telefono' => '0986543212',
                'fecha_nacimiento' => '2000-01-20',
            ],

            [
                'cedula' => '5566778899',
                'nombres' => 'Agapo',
                'apellidos' => '',
                'telefono' => '0986543210',
                'fecha_nacimiento' => '1985-05-20',
            ],
        ]);
    }
}

