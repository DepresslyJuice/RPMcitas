<?php

namespace App\Livewire\Pacientes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Paciente;

class ListaPacientes extends Component
{
    use WithPagination;

    public $cedula, $nombre, $apellido, $telefono, $direccion;
    public $pacienteId;
    public $modalOpen = false;
    public $modalTitle = 'Nuevo Paciente';

    protected $rules = [
        'cedula' => 'required|string|max:20|unique:pacientes,cedula',
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'telefono' => 'nullable|string|max:15',
        'direccion' => 'nullable|string|max:255',
    ];

    public function render()
    {
        return view('livewire.pacientes.lista-pacientes', [
            'pacientes' => Paciente::paginate(10)
        ]);
    }

    public function nuevoPaciente()
    {
        $this->reset(['cedula', 'nombre', 'apellido', 'telefono', 'direccion', 'pacienteId']);
        $this->modalTitle = 'Nuevo Paciente';
        $this->modalOpen = true;
    }

    public function editarPaciente($id)
    {
        $paciente = Paciente::findOrFail($id);
        $this->pacienteId = $paciente->id;
        $this->cedula = $paciente->cedula;
        $this->nombre = $paciente->nombre;
        $this->apellido = $paciente->apellido;
        $this->telefono = $paciente->telefono;
        $this->direccion = $paciente->direccion;
        $this->modalTitle = 'Editar Paciente';
        $this->modalOpen = true;
    }

    public function guardarPaciente()
    {
        $this->validate();

        if ($this->pacienteId) {
            $paciente = Paciente::findOrFail($this->pacienteId);
            $paciente->update([ 
                'cedula' => $this->cedula,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
            ]);
        } else {
            Paciente::create([
                'cedula' => $this->cedula,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
            ]);
        }

        $this->modalOpen = false;
        session()->flash('message', 'Paciente guardado correctamente.');
    }

    public function eliminarPaciente($id)
    {
        Paciente::findOrFail($id)->delete();
        session()->flash('message', 'Paciente eliminado correctamente.');
    }
}
