<?php

namespace App\Livewire\Calendarios;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\AgendaCita;
use App\Models\Doctor;
use App\Models\Consultorio;
use App\Models\TipoCita;
use App\Models\User;

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
        $this->actualizarSemana();

        // Si el usuario es un dentista, aplicar automáticamente el filtro por doctor
        if (auth()->user()->hasRole('Dentista')) {
            $this->doctorId = auth()->user()->cedula; // Asumiendo que la cédula del doctor es única
        }
    }


    public function aplicarFiltros()
    {
        $this->actualizarSemana();
    }

    public function actualizarSemana()
    {
        $this->inicioSemana = Carbon::now()->startOfWeek()->addWeeks($this->semana);
        $this->finSemana = Carbon::now()->endOfWeek()->addWeeks($this->semana);

        $citasQuery = AgendaCita::whereBetween('fecha', [$this->inicioSemana, $this->finSemana]);

        // Convertir a entero para comparación precisa
        if ($this->consultorioId) {
            $citasQuery->where('consultorio', strval($this->consultorioId));
        }

        if ($this->tipoCitaId) {
            $citasQuery->where('tipo_cita', strval($this->tipoCitaId));
        }

        // Verificar si el usuario es un odontólogo
        if (auth()->user()->hasRole('Dentista')) {
            // Comparar la cédula del doctor logueado con la cédula del doctor en la vista
            $cedulaDoctorLogueado = auth()->user()->cedula;
            $citasQuery->where('doctor_cedula', $cedulaDoctorLogueado); // Suponiendo que 'doctor_cedula' es el campo en la vista
        }

        // Si se proporciona un doctor específico, filtrar por él
        if ($this->doctorId) {
            $citasQuery->where('doctor', strval($this->doctorId));
        }


        //dump($this->consultorioId, $this->tipoCitaId, $this->doctorId, auth()->user()->role);
        $citas = $citasQuery->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        $this->citasPorDia = $citas->groupBy(function ($cita) {
            return Carbon::parse($cita->fecha)->format('l');
        })->toArray();
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
