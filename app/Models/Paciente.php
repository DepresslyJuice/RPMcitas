<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
    ];

    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class);
    }
}
