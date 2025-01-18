<?php

namespace App\Http\Controllers;

use App\Models\AgendaCita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaCitaController extends Controller
{
    public function index(Request $request)
    {
        // Convertir el valor de la semana a entero (por defecto 0)
        $semana = (int) $request->input('week', 0);

        // Calcular el inicio y fin de la semana
        $inicioSemana = Carbon::now()->startOfWeek()->addWeeks($semana);
        $finSemana = Carbon::now()->endOfWeek()->addWeeks($semana);

        // Obtener citas dentro del rango de fechas
        $citas = AgendaCita::whereBetween('fecha', [$inicioSemana, $finSemana])
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        // Agrupar las citas por día de la semana
        $citasPorDia = $citas->groupBy(function ($cita) {
            return Carbon::parse($cita->fecha)->format('l'); // Día de la semana en inglés
        });

        return view('agenda.index', compact('citasPorDia', 'semana', 'inicioSemana', 'finSemana'));
    }
}
