@extends('layouts.app')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Doctor</h1>

    <form action="{{ route('doctores.update', $doctor->cedula) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula', $doctor->cedula) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" id="nombres" class="form-control" value="{{ old('nombres', $doctor->nombres) }}">
            @error('nombres') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos', $doctor->apellidos) }}">
            @error('apellidos') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $doctor->telefono) }}">
            @error('telefono') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $doctor->email) }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="especialidades" class="form-label">Especialidades</label><br>
            @foreach ($especialidades as $especialidad)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="especialidades[]" value="{{ $especialidad->id }}" 
                    {{ in_array($especialidad->id, $doctor->especialidades->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label" for="especialidades">{{ $especialidad->nombre }}</label>
                </div>
            @endforeach
            @error('especialidades') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('doctores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
