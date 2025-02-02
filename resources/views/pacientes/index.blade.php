@extends('layouts.app')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Pacientes</h1>

    <a href="{{ route('pacientes.create') }}" class="btn btn-primary mb-3">Añadir Paciente</a>
    <h4>Buscar Paciente</h4>
    <form method="GET" action="{{ route('pacientes.index') }}">
        <input type="text" name="search" placeholder="Buscar paciente" class="form-search" value="{{ request('search') }}">
        <button type="submit" class="btn-secondary">Buscar</button>
    </form>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre Completo</th>
                <th>Teléfono</th>
                <th>Fecha de Nacimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->cedula }}</td>
                    <td>{{ $paciente->nombres }} {{ $paciente->apellidos }}</td>
                    <td>{{ $paciente->telefono }}</td>
                    <td>{{ $paciente->fecha_nacimiento }}</td>               
                    <td>
                        <a href="{{ route('pacientes.edit', $paciente->cedula) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('pacientes.destroy', $paciente->cedula) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este doctor?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @vite('resources/css/CRUDS/index.css')
</div>
@endsection
