@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Registro de Auditoría</h2>

    <!-- Filtros -->
    <form method="GET" class="mb-4">
        <div class="row">
            <!-- Filtro por Tabla -->
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <label for="tabla">Tabla</label>
                <select name="tabla" class="form-control">
                    <option value="">Todas</option>
                    @foreach($tablas as $tabla)
                        <option value="{{ $tabla }}" {{ request('tabla') == $tabla ? 'selected' : '' }}>
                            {{ ucfirst($tabla) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por Usuario -->
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <label for="usuario">Usuario</label>
                <select name="usuario" class="form-control">
                    <option value="">Todos</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario }}" {{ request('usuario') == $usuario ? 'selected' : '' }}>
                            Usuario #{{ $usuario }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por Fecha -->
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <label for="fecha_inicio">Fecha inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <label for="fecha_fin">Fecha fin</label>
                <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
    </form>

    <!-- Tabla de Auditoría -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tabla</th>
                    <th>Descripción</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($auditorias as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ ucfirst($log->log_name) }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->causer_id ?? 'Sistema' }}</td>
                        <td>{{ $log->created_at->format('Y-m-d') }}</td>
                        <td>{{ $log->created_at->format('H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay registros</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $auditorias->links() }}
    </div>
</div>
@endsection