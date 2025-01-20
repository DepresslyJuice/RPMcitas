<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitasSeeder extends Seeder
{
    public function run()
    {
        DB::table('citas')->insert([
            [
                'paciente_id' => '1122334455',
                'fecha' => '2025-01-21',
                'hora_inicio' => '10:00:00',
                'hora_fin' => '10:30:00',
                'descripcion' => 'Consulta inicial',
                'doctor_id' => '1234567890',
                'tipo_cita_id' => 1,
                'consultorio_id' => 1,
                'estado_citas_id' => 1,
            ],
            [
                'paciente_id' => '2233445566',
                'fecha' => '2025-01-22',
                'hora_inicio' => '11:00:00',
                'hora_fin' => '11:30:00',
                'descripcion' => 'Control de ortodoncia',
                'doctor_id' => '0987654321',
                'tipo_cita_id' => 2,
                'consultorio_id' => 2,
                'estado_citas_id' => 2,
            ],
        ]);
    }
}

