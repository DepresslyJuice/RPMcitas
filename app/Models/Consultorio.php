<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultorio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'consultorios';

    protected $fillable = [
        'nombre',
        'direccion',
    ];
    protected static function booted()
    {
        static::deleting(function ($consultorio) {
            // Cambiar el consultorio_id de todas las citas posteriores al eliminar el consultorio
            CitaMedica::where('consultorio_id', $consultorio->id)
                ->where('fecha', '>=', now()) // Suponiendo que tienes un campo fecha o algo similar para determinar si es posterior
                ->update(['consultorio_id' => 1]); // Asigna 'no asignado'
    
            // Concatenar "(eliminado)" al nombre del consultorio solo al eliminar
            if ($consultorio->trashed()) {
                $consultorio->nombre .= ' (eliminado)'; // Concatenar "(eliminado)" al nombre
            }
        });
    }

    /**
     * Relación con el modelo CitaMedica.
     */
    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class, 'consultorio_id');
    }
}
