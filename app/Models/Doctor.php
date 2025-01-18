<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores';

    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'email',
        'telefono',
    ];

    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class);
    }
}
