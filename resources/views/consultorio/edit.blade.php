@extends('adminlte::page')
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Consultorio</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('consultorios.update', $consultorio->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre del Consultorio</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $consultorio->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $consultorio->direccion) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('consultorios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    @vite('resources/css/CRUDS/create.css')
</div>
@endsection
