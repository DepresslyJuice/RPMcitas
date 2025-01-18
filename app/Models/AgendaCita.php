<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaCita extends Model
{
    // Definir el nombre de la vista
    protected $table = 'agenda_citas';

    // Indicar que este modelo no tiene timestamps (created_at y updated_at)
    public $timestamps = false;

    // Hacer que el modelo sea de solo lectura
    public function save(array $options = [])
    {
        throw new \Exception("Cannot save to a database view.");
    }

    public function delete()
    {
        throw new \Exception("Cannot delete from a database view.");
    }
}
