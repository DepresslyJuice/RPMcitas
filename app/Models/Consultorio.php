<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;

    protected $table = 'consultorios';

    protected $fillable = [
        'nombre',
        'direccion',
    ];

    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class);
    }
}
