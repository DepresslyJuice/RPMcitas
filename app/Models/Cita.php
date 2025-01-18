<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo (opcional si sigue las convenciones de Laravel)
    protected $table = 'citas_medicas';

    // Especificar los campos que se pueden asignar en masa
    protected $fillable = [
        'descripcion',
        'fecha',
        'hora_inicio',
        'hora_final',
        'paciente_id',
        'doctor_id'
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación con el modelo Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Obtener la duración de la cita en minutos
    public function getDuracionAttribute()
    {
        $inicio = strtotime($this->hora_inicio);
        $final = strtotime($this->hora_final);
        return ($final - $inicio) / 60; // Duración en minutos
    }
}
