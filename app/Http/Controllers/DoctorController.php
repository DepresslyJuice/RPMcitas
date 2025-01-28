<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Mostrar una lista de todos los doctores.
     */
    public function index()
    {
        $doctores = Doctor::with('especialidades')->get(); // Obtener doctores con especialidades
        return view('doctores.index', compact('doctores'));
    }

    /**
     * Mostrar el formulario para crear un nuevo doctor.
     */
    public function create()
    {
        $especialidades = Especialidad::all(); // Obtener todas las especialidades
        return view('doctores.create', compact('especialidades'));
    }

    /**
     * Guardar un nuevo doctor en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'cedula' => 'required|string|max:20|unique:doctores',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:doctores',
            'especialidades' => 'required|array', // Debe ser un array
            'especialidades.*' => 'exists:especialidades,id', // Cada especialidad debe existir
        ]);

        // Crear el doctor
        $doctor = Doctor::create($request->only(['cedula', 'nombres', 'apellidos', 'telefono', 'email']));

        // Asociar las especialidades
        $doctor->especialidades()->attach($request->especialidades);

        return redirect()->route('doctores.index')->with('success', 'Doctor creado correctamente.');
    }

    /**
     * Mostrar los detalles de un doctor específico.
     */
    public function show($id)
    {
        $doctor = Doctor::with('especialidades')->findOrFail($id); // Cargar especialidades relacionadas
        return view('doctores.show', compact('doctor'));
    }

    /**
     * Mostrar el formulario para editar un doctor existente.
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $especialidades = Especialidad::all(); // Obtener todas las especialidades
        return view('doctores.edit', compact('doctor', 'especialidades'));
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
            'email' => "required|email|max:255|unique:doctores,email,{$id},cedula", // Permitir el mismo email si no cambia
            'especialidades' => 'required|array',
            'especialidades.*' => 'exists:especialidades,id',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->only(['nombres', 'apellidos', 'telefono', 'email']));

        // Actualizar las especialidades asociadas
        $doctor->especialidades()->sync($request->especialidades);

        return redirect()->route('doctores.index')->with('success', 'Doctor actualizado correctamente.');
    }

    /**
     * Eliminar un doctor de la base de datos.
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctores.index')->with('success', 'Doctor eliminado correctamente.');
    }
}


