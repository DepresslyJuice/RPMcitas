@extends('adminlte::page')

@section('title', 'Listado de Citas Médicas')

@section('content')
    <div class="container">
        <h1 class="text-center">Citas Médicas</h1>
        <a href="{{ route('citas.create') }}" class="btn btn-primary mb-3">Nueva Cita</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Consultorio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($citas as $cita)
                    <tr>
                        <td>{{ $cita->paciente->nombres }}</td>
                        <td>{{ $cita->doctor->nombres }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                        <td>{{ $cita->consultorio->nombre }}</td>
                        <td>
                            <a href="{{ route('citas.show', $cita) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('citas.edit', $cita) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('citas.destroy', $cita) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar esta citas?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay citas registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $citas->links() }}
        
        </div>
        @vite('resources/css/CRUDS/index.css')
    </div>
@endsection

@vite('resources/css/cita_medica.css')


