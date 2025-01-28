<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up()
    {
        // Tabla consultorios
        Schema::create('consultorios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->timestamps();
        });

        Schema::create('especialidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('doctores', function (Blueprint $table) {
            $table->string('cedula')->primary();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('doctor_especialidad', function (Blueprint $table) {
            $table->string('doctor_id');
            $table->foreign('doctor_id')->references('cedula')->on('doctores')->cascadeOnDelete();
            $table->unsignedBigInteger('especialidad_id');
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->cascadeOnDelete();
            $table->primary(['doctor_id', 'especialidad_id']);
            $table->timestamps();
        });

        Schema::create('pacientes', function (Blueprint $table) {
            $table->string('cedula')->primary();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });

        Schema::create('tipo_citas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('estado_citas', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('paciente_id');
            $table->foreign('paciente_id')->references('cedula')->on('pacientes')->cascadeOnDelete();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->text('descripcion');
            $table->string('doctor_id');
            $table->foreign('doctor_id')->references('cedula')->on('doctores')->cascadeOnDelete();
            $table->unsignedBigInteger('tipo_cita_id');
            $table->foreign('tipo_cita_id')->references('id')->on('tipo_citas')->cascadeOnDelete();
            $table->unsignedBigInteger('consultorio_id');
            $table->foreign('consultorio_id')->references('id')->on('consultorios')->cascadeOnDelete();
            $table->unsignedBigInteger('estado_citas_id');
            $table->foreign('estado_citas_id')->references('id')->on('estado_citas')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('historias_clinicas', function (Blueprint $table) {
            $table->id();
            $table->string('paciente_id');
            $table->foreign('paciente_id')->references('cedula')->on('pacientes')->cascadeOnDelete();
            $table->date('fecha_creacion');
            $table->text('motivo_consulta');
            $table->text('diagnostico');
            $table->text('tratamiento_planificado');
            $table->text('tratamiento_realizado');
            $table->timestamps();
        });

        Schema::create('condiciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        Schema::create('antecedentes_familiares', function (Blueprint $table) {
            $table->id();
            $table->string('paciente_id');
            $table->foreign('paciente_id')->references('cedula')->on('pacientes')->cascadeOnDelete();
            $table->string('familiar');
            $table->unsignedBigInteger('condicion_id');
            $table->foreign('condicion_id')->references('id')->on('condiciones')->cascadeOnDelete();
            $table->text('descripcion');
            $table->timestamps();
        });

        Schema::create('antecedentes_personales', function (Blueprint $table) {
            $table->id();
            $table->string('paciente_id');
            $table->foreign('paciente_id')->references('cedula')->on('pacientes')->cascadeOnDelete();
            $table->unsignedBigInteger('condicion_id');
            $table->foreign('condicion_id')->references('id')->on('condiciones')->cascadeOnDelete();
            $table->text('descripcion');
            $table->timestamps();
        });

        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historia_clinica_id');
            $table->foreign('historia_clinica_id')->references('id')->on('historias_clinicas')->cascadeOnDelete();
            $table->string('presion_arterial');
            $table->integer('frecuencia_cardiaca');
            $table->decimal('temperatura', 5, 2);
            $table->integer('frecuencia_respiratoria');
            $table->integer('saturacion_oxigeno');
            $table->dateTime('fecha_registro');
            $table->timestamps();
        });

        Schema::create('evaluaciones_sistema_estomatognatico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historia_clinica_id');
            $table->foreign('historia_clinica_id')->references('id')->on('historias_clinicas')->cascadeOnDelete();
            $table->dateTime('fecha_evaluacion');
            $table->string('masticacion');
            $table->string('deglucion');
            $table->string('fonacion');
            $table->text('tejidos_blandos');
            $table->text('articulaciones');
            $table->text('otros_hallazgos');
            $table->timestamps();
        });

        Schema::create('odontogramas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historia_clinica_id');
            $table->foreign('historia_clinica_id')->references('id')->on('historias_clinicas')->cascadeOnDelete();
            $table->dateTime('fecha_creacion');
            $table->text('observaciones');
            $table->timestamps();
        });

        Schema::create('dientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('odontograma_id');
            $table->foreign('odontograma_id')->references('id')->on('odontogramas')->cascadeOnDelete();
            $table->integer('numero');
            $table->string('tipo');
            $table->string('posicion');
            $table->timestamps();
        });

        Schema::create('superficies_dentales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diente_id');
            $table->foreign('diente_id')->references('id')->on('dientes')->cascadeOnDelete();
            $table->string('superficie');
            $table->string('estado');
            $table->text('observaciones');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('superficies_dentales');
        Schema::dropIfExists('dientes');
        Schema::dropIfExists('odontogramas');
        Schema::dropIfExists('evaluaciones_sistema_estomatognatico');
        Schema::dropIfExists('signos_vitales');
        Schema::dropIfExists('antecedentes_personales');
        Schema::dropIfExists('antecedentes_familiares');
        Schema::dropIfExists('condiciones');
        Schema::dropIfExists('historias_clinicas');
        Schema::dropIfExists('citas');
        Schema::dropIfExists('estado_citas');
        Schema::dropIfExists('tipo_citas');
        Schema::dropIfExists('pacientes');
        Schema::dropIfExists('doctor_especialidad');
        Schema::dropIfExists('doctores');
        Schema::dropIfExists('especialidades');
        Schema::dropIfExists('consultorios');
    }
}
