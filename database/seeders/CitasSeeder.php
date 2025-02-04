<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitasSeeder extends Seeder
{
    public function run()
    {
        DB::table('citas')->insert([
            // Cita con el doctor Juan Pérez
            [
                'paciente_id' => '1122334455',
                'fecha' => '2025-01-29',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '09:30:00',
                'descripcion' => 'Consulta de revisión general',
                'doctor_id' => '1004077457',
                'tipo_cita_id' => 1,
                'consultorio_id' => 2,
                'estado_citas_id' => 1,
            ],
            // Cita con la doctora María García
            [
                'paciente_id' => '2233445566',
                'fecha' => '2025-01-30',
                'hora_inicio' => '10:00:00',
                'hora_fin' => '10:30:00',
                'descripcion' => 'Limpieza dental',
                'doctor_id' => '1004077458',
                'tipo_cita_id' => 2,
                'consultorio_id' => 2,
                'estado_citas_id' => 1,
            ],
            // Cita con el doctor Carlos Estupiñan
            [
                'paciente_id' => '3344556677',
                'fecha' => '2025-02-01',
                'hora_inicio' => '14:00:00',
                'hora_fin' => '14:45:00',
                'descripcion' => 'Extracción de muela del juicio',
                'doctor_id' => '1004077459',
                'tipo_cita_id' => 3,
                'consultorio_id' => 3,
                'estado_citas_id' => 2,
            ],
            // Repetir un doctor para otra cita
            [
                'paciente_id' => '4455667788',
                'fecha' => '2025-02-02',
                'hora_inicio' => '15:00:00',
                'hora_fin' => '15:30:00',
                'descripcion' => 'Control postoperatorio',
                'doctor_id' => '1004077457',
                'tipo_cita_id' => 2,
                'consultorio_id' => 4,
                'estado_citas_id' => 1,
            ],
            // Otro paciente con María García
            [
                'paciente_id' => '5566778899',
                'fecha' => '2025-02-03',
                'hora_inicio' => '11:30:00',
                'hora_fin' => '12:00:00',
                'descripcion' => 'Consulta inicial',
                'doctor_id' => '1004077458',
                'tipo_cita_id' => 1,
                'consultorio_id' => 2,
                'estado_citas_id' => 1,
            ],


            [
                'paciente_id' => '5566778899',
                'fecha' => '2025-01-28',
                'hora_inicio' => '11:30:00',
                'hora_fin' => '12:00:00',
                'descripcion' => 'Consulta inicial',
                'doctor_id' => '1004077458',
                'tipo_cita_id' => 1,
                'consultorio_id' => 2,
                'estado_citas_id' => 1,
            ],

            [
                'paciente_id' => '4455667788',
                'fecha' => '2025-01-28',
                'hora_inicio' => '14:30:00',
                'hora_fin' => '15:00:00',
                'descripcion' => 'Consulta inicial',
                'doctor_id' => '1004077458',
                'tipo_cita_id' => 1,
                'consultorio_id' => 2,
                'estado_citas_id' => 1,
            ],
        ]);
    }
}

