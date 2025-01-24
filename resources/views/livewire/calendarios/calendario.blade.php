<div class="container">
    {{-- CALENDARIO SEMANAL --}}
    <div id="calendario-semanal" class="container py-4">
        <h1 class="text-center mb-4">Agenda Semanal</h1>

        {{-- Controles de semana --}}
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-auto">
                <button wire:click="cambiarSemana(-1)" class="btn btn-primary">Semana Anterior</button>
            </div>
            <div class="col-auto">
                <h5 class="text-center mb-0">{{ $inicioSemana->format('d M, Y') }} - {{ $finSemana->format('d M, Y') }}</h5>
            </div>
            <div class="col-auto">
                <button wire:click="cambiarSemana(1)" class="btn btn-primary">Semana Siguiente</button>
            </div>
        </div>

        {{-- Botón para ver citas del día --}}
        <div class="d-flex justify-content-end mb-4">
            <button id="ver-citas-dia" class="btn btn-info">Ver Citas del Día</button>
        </div>

        {{-- Tabla de calendario semanal --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        @php
                            $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                        @endphp
                        @foreach ($diasSemana as $index => $dia)
                            <th>
                                <div>{{ $dia }}</div>
                                <div class="text-muted small">
                                    {{ $inicioSemana->copy()->addDays($index)->format('d') }}
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @php
                            $dias = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        @endphp
                        @foreach ($dias as $dia)
                            <td>
                                @if (isset($citasPorDia[$dia]))
                                    @foreach ($citasPorDia[$dia] as $cita)
                                        <a href="{{ route('citas.show', $cita['cita_id']) }}" class="text-decoration-none">
                                            <div class="mb-3 p-2 border rounded bg-light">
                                                <strong>{{ $cita['hora_inicio'] }} - {{ $cita['hora_final'] }}</strong><br>
                                                <span>{{ $cita['tipo_cita'] }}</span><br>
                                                <small>Paciente: {{ $cita['paciente'] }}</small><br>
                                                <small>Doctor: {{ $cita['doctor'] }}</small><br>
                                                <small>{{ $cita['descripcion'] }}</small>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <p class="text-muted">No hay citas</p>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- CALENDARIO POR DÍA --}}
    <div id="calendario-dia" class="container py-4" style="display: none;">
        <h1 class="text-center mb-4">Citas del Día: {{ \Carbon\Carbon::parse($fecha)->format('d M, Y') }}</h1>

        @if (!isset($citas))
            <div class="alert alert-warning text-center">
                No hay citas para este día.
            </div>
        @else
            {{-- Formulario para cambiar la fecha --}}
            <form wire:submit.prevent="actualizarFecha" class="mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <input type="date" wire:model="fecha" class="form-control" value="{{ $fecha }}">
                    </div>
                    <div class="col-auto">
                        <button id="ver-citas" type="submit" class="btn btn-success">Ver Citas</button>
                    </div>
                </div>
            </form>

            {{-- Tabla de citas del día --}}
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Hora Inicio</th>
                            <th>Hora Final</th>
                            <th>Descripción</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $cita)
                            <tr>
                                <td>{{ $cita['hora_inicio'] }}</td>
                                <td>{{ $cita['hora_final'] }}</td>
                                <td>{{ $cita['descripcion'] }}</td>
                                <td>{{ $cita['paciente'] }}</td>
                                <td>{{ $cita['doctor'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Botón para volver a la agenda semanal --}}
        <div class="d-flex justify-content-end mt-4">
            <button id="volver-agenda-semanal" class="btn btn-primary">Volver a la Agenda Semanal</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const calendarioSemanal = document.getElementById('calendario-semanal');
        const calendarioDia = document.getElementById('calendario-dia');

        document.getElementById('ver-citas-dia').addEventListener('click', () => {
            calendarioSemanal.style.display = 'none';
            calendarioDia.style.display = 'block';
        });

        document.getElementById('volver-agenda-semanal').addEventListener('click', () => {
            calendarioDia.style.display = 'none';
            calendarioSemanal.style.display = 'block';
        });
    });
</script>
