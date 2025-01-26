<?php
namespace App\Livewire\Calendarios;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\AgendaCita;

class CalendarioDiario extends Component
{
    public $fecha;
    public $citas = [];

    public function mount()
    {
        $this->fecha = Carbon::now()->format('Y-m-d'); // Establecer la fecha actual por defecto
        $this->citasDelDia(); // Cargar las citas para el día actual
    }

    public function actualizarFecha()
    {
        // Actualizar las citas según la fecha seleccionada
        $this->citasDelDia();
    }

    public function citasDelDia()
    {
        // Obtener las citas del día
        $citasDelDia = AgendaCita::whereDate('fecha', $this->fecha)
            ->orderBy('hora_inicio')
            ->get();

        // Convertir la colección en un array
        $this->citas = $citasDelDia->toArray();
    }

    public function render()
    {
        return view('livewire.calendarios.calendario-diario');
    }
}