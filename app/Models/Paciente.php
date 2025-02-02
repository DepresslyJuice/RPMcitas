<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Carbon\Carbon;

class Paciente extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'pacientes';
    protected $primaryKey = 'cedula';
    protected $keyType = 'string';
    protected $fillable = [
        'cedula',
        'nombres',
        'apellidos',
        'telefono',
        'fecha_nacimiento',
    ];

    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class);
    }

    /**
     * Configuración de la auditoría con Spatie Activity Log
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nombres', 'apellidos', 'telefono', 'fecha_nacimiento']) // Campos a auditar
            ->logOnlyDirty() // Solo registra cambios reales
            ->useLogName('pacientes')
            ->dontSubmitEmptyLogs(); // Evita logs vacíos
    }

    public function citas()
    {
        return $this->hasMany(CitaMedica::class, 'paciente_id');
    }

    public function getEdadAttribute()
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }
    /**
     * Mensaje personalizado en los logs de auditoría.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return "El paciente {$this->nombres} {$this->apellidos} ha sido {$eventName} por " . (auth()->user()->name ?? 'Sistema');
    }
}
