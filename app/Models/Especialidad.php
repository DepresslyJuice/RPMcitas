<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades'; 

    /**
     * Relación muchos a muchos con Doctores.
     */
    public function doctores()
    {
        return $this->belongsToMany(
            Doctor::class,
            'doctor_especialidad', 
            'especialidad_id', 
            'doctor_id'
        );
    }
}
