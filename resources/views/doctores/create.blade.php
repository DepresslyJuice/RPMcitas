@extends('layouts.app')

@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nuevo Doctor</h1>

    <form action="{{ route('doctores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula') }}">
            @error('cedula')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" id="nombres" class="form-control" value="{{ old('nombres') }}">
            @error('nombres')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos') }}">
            @error('apellidos')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
            @error('telefono')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="especialidades" class="form-label">Especialidades</label>
            <div class="form-check">
                @foreach ($especialidades as $especialidad)
                    <input type="checkbox" name="especialidades[]" id="especialidad_{{ $especialidad->id }}" 
                           class="form-check-input" value="{{ $especialidad->id }}" 
                           @if(in_array($especialidad->id, old('especialidades', []))) checked @endif>
                    <label class="form-check-label" for="especialidad_{{ $especialidad->id }}">
                        {{ $especialidad->nombre }}
                    </label>
                    <br>
                @endforeach
            </div>
            <div class="mt-2">
                <a href="{{ route('especialidades.index') }}" class="btn btn-warning btn-sm">Añadir nueva especialidad</a>
            </div>
            @error('especialidades')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('doctores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
