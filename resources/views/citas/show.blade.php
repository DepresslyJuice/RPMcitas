@extends('adminlte::page')

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detalles de la Cita Médica</h3>
                <div class="card-tools">
                    <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-sm btn-primary mr-2">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fas fa-user mr-1"></i> Paciente</strong>
                        <p class="text-muted">
                            {{ $cita->paciente->nombres }} {{ $cita->paciente->apellidos }}
                            (Cédula: {{ $cita->paciente_id }})
                        </p>

                        <strong><i class="fas fa-user-md mr-1"></i> Doctor</strong>
                        <p class="text-muted">
                            {{ $cita->doctor->nombres }} {{ $cita->doctor->apellidos }}
                            (Cédula: {{ $cita->doctor_id }})
                        </p>
                    </div>

                    <div class="col-md-6">
                        <strong><i class="fas fa-calendar mr-1"></i> Fecha y Hora</strong>
                        <p class="text-muted">
                            {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                            ({{ $cita->hora_inicio }} - {{ $cita->hora_fin }})
                        </p>

                        <strong><i class="fas fa-clock mr-1"></i> Duración</strong>
                        <p class="text-muted">
                            {{ $cita->duracion ? $cita->duracion . ' minutos' : 'No disponible' }}
                        </p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fas fa-briefcase mr-1"></i> Consultorio</strong>
                        <p class="text-muted">
                            {{ $cita->consultorio->nombre }}
                        </p>

                        <strong><i class="fas fa-tags mr-1"></i> Tipo de Cita</strong>
                        <p class="text-muted">
                            {{ $cita->tipoCita->nombre }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <strong><i class="fas fa-info-circle mr-1"></i> Estado</strong>
                        <p class="text-muted">
                            {{ $cita->estadoCita->estado }}
                        </p>

                        <strong><i class="fas fa-sticky-note mr-1"></i> Descripción</strong>
                        <p class="text-muted">
                            {{ $cita->descripcion ?? 'Sin descripción' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="float-right d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
