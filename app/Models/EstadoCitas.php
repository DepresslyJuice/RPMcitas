<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCitas extends Model
{
    use HasFactory;

    // Define la tabla asociada al modelo si no sigue las convenciones
    protected $table = 'estado_citas';

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'nombre',
        'descripcion', // Si quieres agregar más detalles sobre el estado
    ];

    // Relación con CitaMedica (opcional si planeas vincular ambos)
    public function citas()
    {
        return $this->hasMany(CitaMedica::class, 'estado_citas_id');
    }
}
