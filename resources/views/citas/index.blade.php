@extends('adminlte::page')

@section('title', 'Listado de Citas Médicas')

@section('content')
    <div class="container">
        <h1 class="text-center">Citas Médicas</h1>
        <a href="{{ route('citas.create') }}" class="btn btn-primary mb-3">Nueva Cita</a>
        <a href="{{ route('reporte-citas') }}" class="btn btn-primary mb-3">Generar Reporte</a>

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
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('citas.show', $cita) }}"
                                        class="btn btn-info btn-sm btn-action">Ver</a>
                                    <a href="{{ route('citas.edit', $cita) }}"
                                        class="btn btn-warning btn-sm btn-action">Editar</a>
                                    @if ($cita->estadoCita->estado !== 'Finalizada')
                                        <form action="{{ route('citas.finalizar', $cita->id) }}" method="POST"
                                            class="btn-action">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Finalizar
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm btn-action" disabled>Finalizada</button>
                                    @endif
                                    <form action="{{ route('citas.destroy', $cita) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-action"
                                            onclick="return confirm('¿Estás seguro de cancelar esta cita?')">Cancelar</button>
                                    </form>
                                </div>
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
