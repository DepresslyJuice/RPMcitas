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
        $query = AgendaCita::whereDate('fecha', $this->fecha);

        // Aplicar filtros usando los nombres de las columnas
        if ($this->consultorioId) {
            $query->where('consultorio', $this->consultorioId);
        }

        if ($this->tipoCitaId) {
            $query->where('tipo_cita', $this->tipoCitaId);
        }

        if ($this->doctorId) {
            $query->where('doctor', $this->doctorId);
        }

        // Ordenar y obtener los resultados
        $citas = $query->orderBy('hora_inicio')->get();

        // Depuración: Mostrar la consulta generada
        // dd($query->toSql(), $query->getBindings());

        // Convertir la colección en un array
        $this->citas = $citas->toArray();
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
