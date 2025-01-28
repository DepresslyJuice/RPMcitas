<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores'; 

    protected $primaryKey = 'cedula'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    /**
     * Campos asignables en la creación o actualización masiva.
     */
    protected $fillable = [
        'cedula',         
        'nombres',       // Nombre del doctor
        'apellidos',     // Apellido del doctor
        'email',         // Email del doctor
        'telefono',      // Teléfono del doctor
    ];

    /**
     * Relación muchos a muchos con Especialidades.
     */
    public function especialidades()
    {
        return $this->belongsToMany(
            Especialidad::class,   
            'doctor_especialidad', 
            'doctor_id',           
            'especialidad_id'      
        );
    }
}

