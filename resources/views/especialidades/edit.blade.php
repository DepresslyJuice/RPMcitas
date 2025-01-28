@extends('adminlte::page')
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Especialidad</h1>

    <form action="{{ route('especialidades.update', $especialidad->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Especialidad</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $especialidad->nombre) }}">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('especialidades.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
