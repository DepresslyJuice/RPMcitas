<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Consultorio;
use App\Models\TipoCita;
use App\Models\EstadoCitas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;




class CitaMedicaController extends Controller
{
    /**
     * Mostrar el listado de citas.
     */
    public function index()
    {
        $citasQuery = CitaMedica::with('paciente', 'doctor', 'consultorio', 'tipoCita', 'estadoCita');

        // Si el usuario es un dentista, filtrar solo sus citas
        if (auth()->user()->hasRole('Dentista')) {
            $citasQuery->where('doctor_id', auth()->user()->cedula);
        }

        // Filtrar solo las citas cuyo estado no sea 'Cancelada'
        $citasQuery->whereHas('estadoCita', function ($query) {
            $query->where('estado', '!=', 'Cancelada');
        });

        // Cargar los consultorios eliminados lógicamente usando `withTrashed()`
        $citasQuery->with(['consultorio' => function ($query) {
            $query->withTrashed(); // Incluir los consultorios eliminados lógicamente
        }]);

        // Obtener las citas con paginación
        $citas = $citasQuery->paginate(10);

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

    public function buscarPacientes(Request $request)
    {
        $search = $request->search;
        $pacientes = Paciente::where('nombres', 'ILIKE', "%$search%")
            ->orWhere('apellidos', 'ILIKE', "%$search%")
            ->orWhere('cedula', 'ILIKE', "%$search%")
            ->limit(10)
            ->get();

        return response()->json($pacientes->map(fn($p) => ['id' => $p->cedula, 'text' => "$p->nombres $p->apellidos - $p->cedula"]));
    }

    public function buscarDoctores(Request $request)
    {
        $search = $request->search;
        $doctores = Doctor::where('nombres', 'ILIKE', "%$search%")
            ->orWhere('apellidos', 'ILIKE', "%$search%")
            ->orWhere('cedula', 'ILIKE', "%$search%")
            ->limit(10)
            ->get();

        return response()->json($doctores->map(fn($d) => ['id' => $d->cedula, 'text' => "$d->nombres $d->apellidos - $d->cedula"]));
    }

    public function buscarTiposCita(Request $request)
    {
        $search = $request->search;
        $tipos = TipoCita::where('nombre', 'ILIKE', "%$search%")->limit(10)->get();
        return response()->json($tipos->map(fn($t) => ['id' => $t->id, 'text' => $t->nombre]));
    }

    public function buscarConsultorios(Request $request)
    {
        $search = $request->search;
        $consultorios = Consultorio::where('nombre', 'ILIKE', "%$search%")->limit(10)->get();
        return response()->json($consultorios->map(fn($c) => ['id' => $c->id, 'text' => $c->nombre]));
    }


    /**
     * Almacenar una nueva cita en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de datos con mensajes personalizados
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,cedula',
            'doctor_id' =>'required|exists:doctores,cedula',
            'consultorio_id' => 'required|exists:consultorios,id',
            'tipo_cita_id' => 'required|exists:tipo_citas,id',
            'estado_citas_id' => 'required|exists:estado_citas,id',
            'fecha' => 'required|date|after_or_equal:today', // La fecha debe ser hoy o después
            'hora_inicio' => 'required|date_format:H:i', // La hora debe ser en el futuro
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio', // La hora de fin debe ser después de la de inicio
            'descripcion' => 'nullable|string|max:255',
        ], [
            'paciente_id.required' => 'El paciente es obligatorio.',
            'paciente_id.exists' => 'El paciente no existe en el sistema.',
            'doctor_id.required' => 'El doctor es obligatorio.',
            'doctor_id.exists' => 'El doctor no existe en el sistema.',
            'consultorio_id.required' => 'El consultorio es obligatorio.',
            'consultorio_id.exists' => 'El consultorio seleccionado no es válido.',
            'fecha.required' => 'La fecha de la cita es obligatoria.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'La hora de inicio debe estar en formato HH:MM.',
            'hora_fin.required' => 'La hora de finalización es obligatoria.',
            'hora_fin.date_format' => 'La hora de finalización debe estar en formato HH:MM.',
            'hora_fin.after' => 'La hora de finalización debe ser después de la hora de inicio.',
        ]);

        // Verificar conflicto de horario para el doctor, excluyendo citas con estado 'cancelada' (ID 3)
        $existeCita = CitaMedica::where('doctor_id', $request->doctor_id)
            ->where('fecha', $request->fecha)
            ->where('hora_inicio', '<', $request->hora_fin)
            ->where('hora_fin', '>', $request->hora_inicio)
            ->where('estado_citas_id', '!=', 3) // Estado distinto de 'cancelada'
            ->exists();

        if ($existeCita) {
            return redirect()->back()->withErrors(['horario' => 'El doctor ya tiene una cita en el horario seleccionado.'])->withInput();
        }

        // Crear la cita
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
        $request->merge([
            'hora_inicio' => date('H:i', strtotime($request->hora_inicio)),
            'hora_fin' => date('H:i', strtotime($request->hora_fin))
        ]);


        $request->validate([
            'paciente_id' => 'required|exists:pacientes,cedula',
            'doctor_id' => 'required|exists:doctores,cedula',
            'consultorio_id' => 'required|exists:consultorios,id',
            'tipo_cita_id' => 'required|exists:tipo_citas,id',
            'estado_citas_id' => 'required|exists:estado_citas,id',
            'fecha' => 'required|date|after_or_equal:today', // La fecha debe ser hoy o después
            'hora_inicio' => 'required|date_format:H:i', // La hora debe ser en el futuro
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio', // La hora de fin debe ser después de la de inicio
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
            ->where('id', '!=', $cita->id) // Excluir la cita actual
            ->exists();

            if ($existeCita) {
                return redirect()->back()->withErrors(['horario' => 'El doctor ya tiene una cita en el horario seleccionado.'])->withInput();
            }

        // Actualizar la cita
        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita médica actualizada exitosamente.');
    }

    /**
     * Eliminar una cita existente de la base de datos.
     */
    public function destroy(CitaMedica $cita)
    {
        $cita->update(['estado_citas_id' => EstadoCitas::where('estado', 'Cancelada')->first()->id]);
        return redirect()->route('citas.index')->with('success', 'Cita médica cancelada exitosamente.');
    }

    public function generarReporte()
    {
        $citas = CitaMedica::with(['paciente', 'doctor', 'consultorio', 'tipoCita', 'estadoCita'])->get();

        // Verifica si hay datos en la consulta
        if ($citas->isEmpty()) {
            return back()->withErrors(['error' => 'No hay citas disponibles para generar el reporte.']);
        }


        $pdf = Pdf::loadView('reportes.citas', compact('citas'));

        return $pdf->download('reporte_citas.pdf');
    }
}
