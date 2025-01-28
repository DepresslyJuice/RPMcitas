@extends('layouts.app')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Doctores</h1>

    <a href="{{ route('doctores.create') }}" class="btn btn-primary mb-3">Crear Nuevo Doctor</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
                        <a href="{{ route('doctores.edit', $doctor->cedula) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('doctores.destroy', $doctor->cedula) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este doctor?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
