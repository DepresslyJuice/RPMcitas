<?php

namespace App\Livewire\Calendarios;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\AgendaCita;
use App\Models\Doctor;
use App\Models\Consultorio;
use App\Models\TipoCita;

class CalendarioSemanal extends Component
{
    public $semana = 0;
    public $inicioSemana;
    public $finSemana;
    public $citasPorDia = [];
    public $fecha;
    public $consultorioId = null;
    public $tipoCitaId = null;
    public $doctorId = null;

    public function mount()
    {
        $this->fecha = Carbon::now()->format('Y-m-d');

        // Si el usuario es un dentista, aplicar automáticamente el filtro por cédula
        if (auth()->user()->hasRole('Dentista')) {
            $this->doctorId = auth()->user()->cedula;
        }

        $this->actualizarSemana();
    }

    public function aplicarFiltros()
    {
        $this->actualizarSemana();
    }

    public function actualizarSemana()
    {
        $this->inicioSemana = Carbon::now()->startOfWeek()->addWeeks($this->semana);
        $this->finSemana = Carbon::now()->endOfWeek()->addWeeks($this->semana);

        $citasQuery = AgendaCita::whereBetween('fecha', [$this->inicioSemana, $this->finSemana])
            ->where('estado_cita', '!=', 'Cancelada');

        // Aplicar filtros correctamente
        if (!empty($this->consultorioId)) {
            $citasQuery->where('consultorio', strval($this->consultorioId));
        }

        if (!empty($this->tipoCitaId)) {
            $citasQuery->where('tipo_cita', strval($this->tipoCitaId));
        }

        if (auth()->user()->hasRole('Dentista')) {
            // Filtrar únicamente por la cédula del usuario logueado
            $citasQuery->where('doctor_cedula', auth()->user()->cedula);
        } elseif (!empty($this->doctorId)) {
            // Si el usuario no es dentista, aplicar filtro normal
            $citasQuery->where('doctor_cedula', strval($this->doctorId));
        }

        // Obtener citas y agruparlas por día
        $citas = $citasQuery->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        $this->citasPorDia = $citas->groupBy(fn($cita) => Carbon::parse($cita->fecha)->format('l'))->toArray();
    }

    public function cambiarSemana($direccion)
    {
        $this->semana += $direccion;
        $this->actualizarSemana();
    }

    public function render()
    {
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $tiposCita = TipoCita::all();

        return view('livewire.calendarios.calendario-semanal', compact('doctores', 'consultorios', 'tiposCita'));
    }
}
