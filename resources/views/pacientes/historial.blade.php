@extends('adminlte::page')

@section('content')
    <h1>Historial del Paciente</h1>
    
    <h2>Datos del Paciente</h2>
    <p><strong>Cédula:</strong> {{ $paciente->cedula }}</p>
    <p><strong>Nombres:</strong> {{ $paciente->nombres }}</p>
    <p><strong>Apellidos:</strong> {{ $paciente->apellidos }}</p>
    <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
    <p><strong>Fecha de Nacimiento: </strong>{{ $paciente->fecha_nacimiento }} ({{$paciente->edad }} años)</p>

    <h2>Citas Médicas</h2>
    @if($paciente->citas->isEmpty())
        <p>El paciente no tiene citas registradas.</p>
    @else
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Doctor</th>
                    <th>Descripción</th>
                    <th>Tipo Cita</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paciente->citas as $cita)
                    <tr>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                        <td>{{ $cita->doctor->nombres }} {{ $cita->doctor->apellidos }}</td>
                        <td>{{ $cita->descripcion }}</td>
                        <td>{{ $cita->tipoCita->nombre }}</td>
                        <td>{{ $cita->estadoCita->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <a href="{{ route('pacientes.index') }}">Volver a la lista</a>
    @vite('resources/css/CRUDS/index.css')
@endsection
