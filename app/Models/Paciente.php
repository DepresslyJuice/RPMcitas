<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    // public $timestamps = false;
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
}
