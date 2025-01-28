@extends('adminlte::page')
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Especialidad</h1>

    <form action="{{ route('especialidades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Especialidad</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('especialidades.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
