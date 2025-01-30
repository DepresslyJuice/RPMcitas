<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::query();

        // Filtro por tabla (log_name)
        if ($request->filled('tabla')) {
            $query->where('log_name', $request->tabla);
        }

        // Filtro por usuario
        if ($request->filled('usuario')) {
            $query->where('causer_id', $request->usuario);
        }

        // Filtro por fecha (rango)
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin]);
        }

        // Ordenar por fecha más reciente
        $auditorias = $query->orderBy('created_at', 'desc')->paginate(10);

        // Obtener nombres de tablas y usuarios para los filtros
        $tablas = Activity::select('log_name')->distinct()->pluck('log_name');
        $usuarios = Activity::whereNotNull('causer_id')->distinct()->pluck('causer_id');

        return view('auditoria.index', compact('auditorias', 'tablas', 'usuarios'));
    }
}
