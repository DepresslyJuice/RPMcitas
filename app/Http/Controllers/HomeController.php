<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaCita;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        return view('home', compact('citasPorDia', 'semana', 'inicioSemana', 'finSemana'));
    }
}
