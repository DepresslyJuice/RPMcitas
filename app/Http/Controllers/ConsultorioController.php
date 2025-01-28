<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    /**
     * Mostrar la lista de consultorios.
     */
    public function index()
    {
        $consultorios = Consultorio::paginate(10);  // Paginar consultorios
        return view('consultorio.index', compact('consultorios'));
    }

    /**
     * Mostrar el formulario para crear un nuevo consultorio.
     */
    public function create()
    {
        return view('consultorio.create');
    }

    /**
     * Almacenar un nuevo consultorio en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ]);

        Consultorio::create($request->all());

        return redirect()->route('consultorios.index')->with('success', 'Consultorio creado exitosamente.');
    }

    /**
     * Mostrar el formulario para editar un consultorio existente.
     */
    public function edit(Consultorio $consultorio)
    {
        return view('consultorio.edit', compact('consultorio'));
    }

    /**
     * Actualizar un consultorio existente en la base de datos.
     */
    public function update(Request $request, Consultorio $consultorio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ]);

        $consultorio->update($request->all());

        return redirect()->route('consultorios.index')->with('success', 'Consultorio actualizado exitosamente.');
    }

    /**
     * Eliminar un consultorio de la base de datos.
     */
    public function destroy(Consultorio $consultorio)
    {
        $consultorio->delete();

        return redirect()->route('consultorios.index')->with('success', 'Consultorio eliminado exitosamente.');
    }
}
