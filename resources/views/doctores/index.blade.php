@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Doctores</h1>

    <a href="{{ route('doctores.create') }}" class="btn btn-primary mb-3">Crear Nuevo Doctor</a>
    <a href="{{ route('reporte-doctores') }}" class="btn btn-primary mb-3">Generar Reporte</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre Completo</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Especialidades</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctores as $doctor)
                <tr>
                    <td>{{ $doctor->cedula }}</td>
                    <td>{{ $doctor->nombres }} {{ $doctor->apellidos }}</td>
                    <td>{{ $doctor->telefono }}</td>
                    <td>{{ $doctor->email }}</td>
                    <td>
                        {{ $doctor->especialidades->pluck('nombre')->join(', ') }}
                    </td>
                    <td>
                        <a href="{{ route('doctores.show', $doctor->cedula) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('doctores.edit', $doctor->cedula) }}" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @vite('resources/css/CRUDS/index.css')
</div>
@endsection
