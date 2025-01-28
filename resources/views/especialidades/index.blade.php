@extends('adminlte::page')
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Especialidades</h1>

    <a href="{{ route('especialidades.create') }}" class="btn btn-primary mb-3">Crear Nueva Especialidad</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades as $especialidad)
                <tr>
                    <td>{{ $especialidad->id }}</td>
                    <td>{{ $especialidad->nombre }}</td>
                    <td>
                        <a href="{{ route('especialidades.edit', $especialidad->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('especialidades.destroy', $especialidad->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta especialidad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
