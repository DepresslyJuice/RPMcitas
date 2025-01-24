<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\AgendaCita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaCitaController extends Controller
{
    public function index(Request $request)
    {
        $semana = (int) $request->input('week', 0);
        $inicioSemana = Carbon::now()->startOfWeek()->addWeeks($semana);
        $finSemana = Carbon::now()->endOfWeek()->addWeeks($semana);

        // Recuperar las citas y asegurarse de incluir el ID
        $citas = AgendaCita::whereBetween('fecha', [$inicioSemana, $finSemana])
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get(['cita_id', 'hora_inicio', 'hora_final', 'tipo_cita', 'paciente', 'doctor', 'descripcion', 'fecha']);

        $citasPorDia = $citas->groupBy(function ($cita) {
            return Carbon::parse($cita->fecha)->format('l'); // Día de la semana en inglés
        });

        return view('agenda.index', compact('citasPorDia', 'semana', 'inicioSemana', 'finSemana'));
    }


    public function citasDelDia(Request $request)
    {
        // Obtener la fecha actual o la indicada
        $fecha = $request->input('fecha', Carbon::now()->format('Y-m-d'));

        // Obtener citas del día
        $citas = AgendaCita::whereDate('fecha', $fecha)
            ->orderBy('hora_inicio')
            ->get();

        return view('agenda.dia', compact('citas', 'fecha'));
    }
}
