@extends('layouts.app')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Paciente</h1>

    <form action="{{ route('pacientes.update', $paciente->cedula) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula', $paciente->cedula) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" id="nombres" class="form-control" value="{{ old('nombres', $paciente->nombres) }}">
            @error('nombres') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos', $paciente->apellidos) }}">
            @error('apellidos') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}">
            @error('telefono') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" 
                value="{{ $paciente->fecha_nacimiento }}" required>
            @error('fecha_nacimiento')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
