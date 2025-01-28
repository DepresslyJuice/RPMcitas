<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Mostrar una lista de todas las especialidades.
     */
    public function index()
    {
        $especialidades = Especialidad::all(); // Obtener todas las especialidades
        return view('especialidades.index', compact('especialidades'));
    }

    /**
     * Mostrar el formulario para crear una nueva especialidad.
     */
    public function create()
    {
        return view('especialidades.create'); // Retorna la vista para crear
    }

    /**
     * Guardar una nueva especialidad en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades', // Nombre único
        ]);

        // Crear la especialidad
        Especialidad::create($request->only('nombre'));

        // Redirigir con un mensaje de éxito
        return redirect()->route('especialidades.index')->with('success', 'Especialidad creada correctamente.');
    }

    /**
     * Mostrar los detalles de una especialidad específica.
     */
    public function show($id)
    {
        $especialidad = Especialidad::findOrFail($id); // Buscar la especialidad
        return view('especialidades.show', compact('especialidad'));
    }

    /**
     * Mostrar el formulario para editar una especialidad existente.
     */
    public function edit($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return view('especialidades.edit', compact('especialidad'));
    }

    /**
     * Actualizar una especialidad existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => "required|string|max:255|unique:especialidades,nombre,{$id}",
        ]);

        $especialidad = Especialidad::findOrFail($id);
        $especialidad->update($request->only('nombre'));

        return redirect()->route('especialidades.index')->with('success', 'Especialidad actualizada correctamente.');
    }

    /**
     * Eliminar una especialidad de la base de datos.
     */
    public function destroy($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();

        return redirect()->route('especialidades.index')->with('success', 'Especialidad eliminada correctamente.');
    }
}
