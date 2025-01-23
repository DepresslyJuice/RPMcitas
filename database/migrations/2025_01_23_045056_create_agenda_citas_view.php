<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAgendaCitasView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW agenda_citas AS
            SELECT 
                c.id AS cita_id,
                c.fecha,
                c.hora_inicio,
                c.hora_fin AS hora_final,
                c.descripcion,
                CONCAT(p.nombres, ' ', p.apellidos) AS paciente,
                CONCAT(d.nombres, ' ', d.apellidos) AS doctor,
                e.nombre AS especialidad,
                co.nombre AS consultorio,
                tc.nombre AS tipo_cita,
                ec.estado AS estado_cita
            FROM 
                citas c
            JOIN 
                pacientes p ON c.paciente_id = p.cedula
            JOIN 
                doctores d ON c.doctor_id = d.cedula
            LEFT JOIN 
                doctor_especialidad de ON d.cedula = de.doctor_id
            LEFT JOIN 
                especialidades e ON de.especialidad_id = e.id
            LEFT JOIN 
                consultorios co ON c.consultorio_id = co.id
            LEFT JOIN 
                tipo_citas tc ON c.tipo_cita_id = tc.id
            LEFT JOIN 
                estado_citas ec ON c.estado_citas_id = ec.id
            ORDER BY 
                c.fecha, c.hora_inicio
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS agenda_citas");
    }
}