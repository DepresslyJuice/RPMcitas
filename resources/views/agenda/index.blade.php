@extends('layouts.app')

@section('title', 'Agenda Semanal')

@section('content')
<div class="container">
    <h1 class="text-center">Agenda Semanal</h1>
    <div class="d-flex justify-content-between mb-3">
        <!-- Botón para la semana anterior -->
        <a href="{{ route('agenda.index', ['week' => $semana - 1]) }}" class="btn btn-primary">Semana Anterior</a>

        <!-- Mostrar rango de la semana actual -->
        <h5>{{ $inicioSemana->format('d M, Y') }} - {{ $finSemana->format('d M, Y') }}</h5>

        <!-- Botón para la semana siguiente -->
        <a href="{{ route('agenda.index', ['week' => $semana + 1]) }}" class="btn btn-primary">Semana Siguiente</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sábado</th>
                    <th>Domingo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @php
                        $dias = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    @endphp

                    @foreach ($dias as $dia)
                        <td>
                            @if (isset($citasPorDia[$dia]))
                                @foreach ($citasPorDia[$dia] as $cita)
                                    <div class="mb-3 p-2 border rounded bg-light">
                                        <strong>{{ $cita->hora_inicio }} - {{ $cita->hora_final }}</strong><br>
                                        <span>{{ $cita->descripcion }}</span><br>
                                        <small>Paciente: {{ $cita->paciente }}</small><br>
                                        <small>Doctor: {{ $cita->doctor }}</small>
                                    </div>
                                @endforeach
                            @else
                                <p>No hay citas</p>
                            @endif
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
