<?php

namespace App\Livewire\Calendarios;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\AgendaCita;

class CalendarioSemanal extends Component
{
    public $semana = 0;
    public $inicioSemana;
    public $finSemana;
    public $citasPorDia = [];
    public $fecha;

    public function mount()
    {
        $this->fecha = Carbon::now()->format('Y-m-d'); // Fecha inicial
        $this->actualizarSemana();
    }

    public function actualizarSemana()
    {
        // Calcular inicio y fin de la semana
        $this->inicioSemana = Carbon::now()->startOfWeek()->addWeeks($this->semana);
        $this->finSemana = Carbon::now()->endOfWeek()->addWeeks($this->semana);

        // Obtener citas dentro del rango
        $citas = AgendaCita::whereBetween('fecha', [$this->inicioSemana, $this->finSemana])
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        // Agrupar las citas por día de la semana
        $this->citasPorDia = $citas->groupBy(function ($cita) {
            return Carbon::parse($cita->fecha)->format('l'); // Día en inglés
        })->toArray(); // Convertir a array para evitar problemas en la vista
    }

    public function cambiarSemana($direccion)
    {
        // Incrementar o decrementar la semana
        $this->semana += $direccion;
        $this->actualizarSemana();
    }

    public function render()
    {
        return view('livewire.calendarios.calendario-semanal');
    }
}
