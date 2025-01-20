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

        // Tabla especialidades
        Schema::create('especialidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Tabla doctores
        Schema::create('doctores', function (Blueprint $table) {
            $table->string('cedula')->primary();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->timestamps();
        });

        // Tabla doctor_especialidad
        Schema::create('doctor_especialidad', function (Blueprint $table) {
            $table->string('doctor_id');
            $table->unsignedBigInteger('especialidad_id');

            $table->foreign('doctor_id')->references('cedula')->on('doctores')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');

            $table->primary(['doctor_id', 'especialidad_id']);
        });

        // Tabla tipo_citas
        Schema::create('tipo_citas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Tabla estado_citas
        Schema::create('estado_citas', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->timestamps();
        });

        // Tabla pacientes
        Schema::create('pacientes', function (Blueprint $table) {
            $table->string('cedula')->primary();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });

        // Tabla citas
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('paciente_id');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->text('descripcion')->nullable();
            $table->string('doctor_id');
            $table->unsignedBigInteger('tipo_cita_id');
            $table->unsignedBigInteger('consultorio_id');
            $table->unsignedBigInteger('estado_citas_id');

            $table->foreign('paciente_id')->references('cedula')->on('pacientes')->onDelete('cascade');
            $table->foreign('doctor_id')->references('cedula')->on('doctores')->onDelete('cascade');
            $table->foreign('tipo_cita_id')->references('id')->on('tipo_citas')->onDelete('cascade');
            $table->foreign('consultorio_id')->references('id')->on('consultorios')->onDelete('cascade');
            $table->foreign('estado_citas_id')->references('id')->on('estado_citas')->onDelete('cascade');

            $table->timestamps();
        });



        // Continuar con las demás tablas siguiendo el mismo patrón
    }

    public function down()
    {
        // Borrar tablas en orden inverso para evitar problemas de dependencias
        Schema::dropIfExists('estado_citas');
        Schema::dropIfExists('tipo_citas');
        Schema::dropIfExists('citas');
        Schema::dropIfExists('pacientes');
        Schema::dropIfExists('doctor_especialidad');
        Schema::dropIfExists('doctores');
        Schema::dropIfExists('especialidades');
        Schema::dropIfExists('consultorios');
    }
}
