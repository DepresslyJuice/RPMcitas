<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Consultorio;
use App\Models\TipoCita;
use App\Models\EstadoCitas;
use Illuminate\Http\Request;

class CitaMedicaController extends Controller
{
    /**
     * Mostrar el listado de citas.
     */
    public function index()
    {
        $citas = CitaMedica::with('paciente', 'doctor', 'consultorio', 'tipoCita', 'estadoCita')->paginate(10);
        return view('citas.index', compact('citas'));
    }

    /**
     * Mostrar el formulario para crear una nueva cita.
     */
    public function create()
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $tiposCita = TipoCita::all();
        $estadosCita = EstadoCitas::all();
        return view('citas.create', compact('pacientes', 'doctores', 'consultorios', 'tiposCita', 'estadosCita'));
    }

    /**
     * Almacenar una nueva cita en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,cedula',
            'doctor_id' => 'required|exists:doctores,cedula',
            'consultorio_id' => 'required|exists:consultorios,id',
            'tipo_cita_id' => 'required|exists:tipo_citas,id',
            'estado_citas_id' => 'required|exists:estado_citas,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'descripcion' => 'nullable|string|max:255',
        ]);

        // Verificar conflicto de horario para el doctor
        $existeCita = CitaMedica::where('doctor_id', $request->doctor_id)
            ->where('fecha', $request->fecha)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                    ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fin', '>=', $request->hora_fin);
                    });
            })->exists();

        if ($existeCita) {
            return back()->withErrors(['error' => 'El doctor ya tiene una cita en el horario seleccionado.'])->withInput();
        }

        CitaMedica::create($request->all());
        return redirect()->route('citas.index')->with('success', 'Cita médica creada exitosamente.');
    }

    /**
     * Mostrar los detalles de una cita.
     */
    public function show(CitaMedica $cita)
    {
        return view('citas.show', compact('cita'));
    }

    /**
     * Mostrar el formulario para editar una cita existente.
     */
    public function edit(CitaMedica $cita)
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $tiposCita = TipoCita::all();
        $estadosCita = EstadoCitas::all();
        return view('citas.edit', compact('cita', 'pacientes', 'doctores', 'consultorios', 'tiposCita', 'estadosCita'));
    }

    /**
     * Actualizar una cita existente en la base de datos.
     */
    public function update(Request $request, CitaMedica $cita)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,cedula',
            'doctor_id' => 'required|exists:doctores,cedula',
            'consultorio_id' => 'required|exists:consultorios,id',
            'tipo_cita_id' => 'required|exists:tipo_citas,id',
            'estado_citas_id' => 'required|exists:estado_citas,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'descripcion' => 'nullable|string|max:255',
        ]);

        // Verificar conflicto de horario para el doctor
        $existeCita = CitaMedica::where('doctor_id', $request->doctor_id)
            ->where('fecha', $request->fecha)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                    ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fin', '>=', $request->hora_fin);
                    });
            })
            ->where('id', '!=', $cita->id)
            ->exists();

        if ($existeCita) {
            return back()->withErrors(['error' => 'El doctor ya tiene una cita en el horario seleccionado.'])->withInput();
        }

        $cita->update($request->all());
        return redirect()->route('citas.index')->with('success', 'Cita médica actualizada exitosamente.');
    }

    /**
     * Eliminar una cita existente de la base de datos.
     */
    public function destroy(CitaMedica $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita médica eliminada exitosamente.');
    }
}
