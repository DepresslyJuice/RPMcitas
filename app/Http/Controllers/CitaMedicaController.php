<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Consultorio;
use Illuminate\Http\Request;

class CitaMedicaController extends Controller
{
    public function index()
    {
        $citas = CitaMedica::with('paciente', 'doctor', 'consultorio')->paginate(10);
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        return view('citas.create', compact('pacientes', 'doctores', 'consultorios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctores,id',
            'consultorio_id' => 'required|exists:consultorios,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'descripcion' => 'nullable|string|max:255',
        ]);

        CitaMedica::create($request->all());
        return redirect()->route('citas.index')->with('success', 'Cita médica creada exitosamente.');
    }

    public function show(CitaMedica $cita)
    {
        return view('citas.show', compact('cita'));
    }

    public function edit(CitaMedica $cita)
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        return view('citas.edit', compact('cita', 'pacientes', 'doctores', 'consultorios'));
    }

    public function update(Request $request, CitaMedica $cita)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctores,id',
            'consultorio_id' => 'required|exists:consultorios,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $cita->update($request->all());
        return redirect()->route('citas.index')->with('success', 'Cita médica actualizada exitosamente.');
    }

    public function destroy(CitaMedica $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita médica eliminada exitosamente.');
    }
}
