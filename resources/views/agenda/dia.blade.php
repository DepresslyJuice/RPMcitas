@extends('layouts.app')

@section('title', 'Citas del Día')

@section('content')
<div class="container">
    <h1 class="text-center">Citas del Día: {{ \Carbon\Carbon::parse($fecha)->format('d M, Y') }}</h1>
    
    @if ($citas->isEmpty())
        <div class="alert alert-warning text-center">
            No hay citas para este día.
        </div>
    @else
    <form method="GET" action="{{ route('agenda.dia') }}" class="mb-3">
        <div class="input-group">
            <input type="date" name="fecha" class="form-control" value="{{ $fecha }}">
            <button type="submit" class="btn btn-success">Ver Citas</button>
        </div>
    </form>
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hora Inicio</th>
                    <th>Hora Final</th>
                    <th>Descripción</th>
                    <th>Paciente</th>
                    <th>Doctor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td>{{ $cita->hora_inicio }}</td>
                        <td>{{ $cita->hora_final }}</td>
                        <td>{{ $cita->descripcion }}</td>
                        <td>{{ $cita->paciente }}</td>
                        <td>{{ $cita->doctor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="d-flex justify-content-end">
        <a href="{{ route('agenda.index') }}" class="btn btn-primary">Volver a la Agenda Semanal</a>
    </div>
</div>
@endsection
