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
        ]);
    }
}

