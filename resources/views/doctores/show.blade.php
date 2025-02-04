@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Detalles del Doctor</h3>
        </div>
        <div class="card-body">
            <p><strong>Cédula:</strong> {{ $doctor->cedula }}</p>
            <p><strong>Nombre:</strong> {{ $doctor->nombres }} {{ $doctor->apellidos }}</p>
            <p><strong>Teléfono:</strong> {{ $doctor->telefono }}</p>
            <p><strong>Email:</strong> {{ $doctor->email }}</p>
            <p><strong>Especialidades:</strong></p>
            <ul>
                @foreach($doctor->especialidades as $especialidad)
                    <li>{{ $especialidad->nombre }}</li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('doctores.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('doctores.edit', $doctor->cedula) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>
@endsection
