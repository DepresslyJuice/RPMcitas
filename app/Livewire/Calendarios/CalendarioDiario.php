<?php

namespace App\Livewire\Calendarios;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\AgendaCita;
use App\Models\Doctor;
use App\Models\Consultorio;
use App\Models\TipoCita;

class CalendarioDiario extends Component
{
    public $fecha;
    public $citas = [];
    public $consultorioId = null;
    public $tipoCitaId = null;
    public $doctorId = null;

    public function mount()
    {
        $this->fecha = Carbon::now()->format('Y-m-d'); // Fecha actual por defecto

        // Si el usuario es un dentista, asignar su cédula como filtro
        if (auth()->user()->hasRole('Dentista')) {
            $this->doctorId = auth()->user()->cedula;
        }

        $this->citasDelDia(); // Cargar citas después de asignar filtros
    }

    public function actualizarFecha()
    {
        // Llamar a citasDelDia para aplicar cambios
        $this->citasDelDia();
    }

    public function citasDelDia()
    {
        // Obtener las citas del día
        $query = AgendaCita::whereDate('fecha', $this->fecha);

        // Aplicar filtros usando los nombres correctos de las columnas
        if (!empty($this->consultorioId)) {
            $query->where('consultorio', strval($this->consultorioId));
        }

        if (!empty($this->tipoCitaId)) {
            $query->where('tipo_cita', strval($this->tipoCitaId));
        }

        if (auth()->user()->hasRole('Dentista')) {
            $cedulaDoctorLogueado = auth()->user()->cedula;
            $query->where('doctor_cedula', $cedulaDoctorLogueado); 
        } elseif (!empty($this->doctorId)) {
            $query->where('doctor_cedula', strval($this->doctorId));
        }

        // Ordenar y obtener los resultados
        $this->citas = $query->orderBy('hora_inicio')->get()->toArray();
    }

    public function render()
    {
        // Cargar los datos necesarios para los filtros
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $tiposCita = TipoCita::all();

        return view('livewire.calendarios.calendario-diario', compact('doctores', 'consultorios', 'tiposCita'));
    }
}
