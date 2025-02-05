<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CitaMedica extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // Guarda todos los atributos
            ->logOnlyDirty() // Solo guarda cambios reales
            ->useLogName('citas_medicas')
            ->dontSubmitEmptyLogs(); // Evita guardar logs vacíos
    }

    /**
     * Tabla asociada al modelo.
     */
    protected $table = 'citas';

    /**
     * Campos que se pueden asignar en masa.
     */
    protected $fillable = [
        'paciente_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'descripcion',
        'doctor_id',
        'tipo_cita_id',
        'consultorio_id',
        'estado_citas_id',
    ];


    //Auditoria
    protected static $logAttributes = ['*']; // Todos los atributos
    protected static $logOnlyDirty = true; // Solo guarda cambios si son diferentes
    protected static $logName = 'citas_medicas';
    protected static $logAttributesToIgnore = ['updated_at']; // Evita cambios irrelevantes
    protected static $submitEmptyLogs = false; // Evita guardar logs vacíos

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Una cita médica ha sido {$eventName} por el usuario " . (auth()->user()->name ?? 'Sistema');
    }

    /**
     * Relación con el modelo Paciente.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'cedula');
    }

    /**
     * Relación con el modelo Doctor.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'cedula');
    }

    /**
     * Relación con el modelo Consultorio.
     */
    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class, 'consultorio_id');
    }

    /**
     * Relación con el modelo TipoCita.
     */
    public function tipoCita()
    {
        return $this->belongsTo(TipoCita::class, 'tipo_cita_id');
    }

    /**
     * Relación con el modelo EstadoCitas.
     */
    public function estadoCita()
    {
        return $this->belongsTo(EstadoCitas::class, 'estado_citas_id');
    }

    /**
     * Obtener la duración de la citas en minutos.
     *
     * @return int|null Duración en minutos, o null si los datos son inválidos.
     */
    public function getDuracionAttribute()
    {
        if ($this->hora_inicio && $this->hora_fin) {
            $inicio = strtotime($this->hora_inicio);
            $final = strtotime($this->hora_fin);

            if ($inicio !== false && $final !== false) {
                return ($final - $inicio) / 60; // Duración en minutos
            }
        }

        return null; // Retorna null si no se puede calcular la duración
    }
}
