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
        <button wire:click="$dispatch('mostrar-diario')" class="btn btn-info">Ver Citas del Día</button>
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