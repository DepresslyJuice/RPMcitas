<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\CitaMedica;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Paciente::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nombres', 'LIKE', "%{$search}%")
                ->orWhere('apellidos', 'LIKE', "%{$search}%")
                ->orWhere('cedula', 'LIKE', "%{$search}%");
        }

        $pacientes = $query->get();

        return view('pacientes.index', compact('pacientes'));
    }


    /**
     * Mostrar el formulario para crear un nuevo paciente.
     */
    public function create()
    {
        $pacientes = Paciente::all();
        return view('pacientes.create', compact('pacientes'));
    }

    /**
     * Guardar un nuevo paciente en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'cedula' => 'required|string|max:20|unique:doctores',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'fecha_nacimiento' => 'required|date',
        ]);


        // Crear el paciente
        $paciente = Paciente::create($request->only(['cedula', 'nombres', 'apellidos', 'telefono', 'email', 'fecha_nacimiento']));
        
        return redirect()->route('pacientes.index', compact('paciente'))->with('success', 'Paciente creado correctamente.');
    }

    /**
     * Mostrar los detalles de un paciente específico.
     */
    public function show($id)
    {
        $doctor = Paciente::all()->findOrFail($id); // Cargar especialidades relacionadas
        return view('pacientes.show', compact('paciente'));
    }

    public function verHistorial($id)
    {
        $paciente = Paciente::with('citas')->findOrFail($id);
        return view('pacientes.historial', compact('paciente'));
    }
    /**
     * Mostrar el formulario para editar un paciente existente.
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Actualizar un doctor existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'fecha_nacimiento' => 'required|date',
        ]);

        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->only(['cedula', 'nombres', 'apellidos', 'telefono', 'email', 'fecha_nacimiento']));

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    /**
     * Eliminar un paciente de la base de datos.
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
}
