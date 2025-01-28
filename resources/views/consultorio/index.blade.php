@extends('adminlte::page')
@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Lista de Consultorios</h1>

    <a href="{{ route('consultorios.create') }}" class="btn btn-primary mb-3">Agregar Consultorio</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultorios as $consultorio)
                <tr>
                    <td>{{ $consultorio->id }}</td>
                    <td>{{ $consultorio->nombre }}</td>
                    <td>{{ $consultorio->direccion }}</td>
                    <td>
                        <a href="{{ route('consultorios.edit', $consultorio->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('consultorios.destroy', $consultorio->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este consultorio?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $consultorios->links() }}
</div>
@endsection
