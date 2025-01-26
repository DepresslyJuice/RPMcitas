<div id="calendario-semanal" class="container py-4">
    <h1 class="text-center mb-4" style="color: #000000;">Agenda Semanal</h1>

    <!-- Controles de semana -->
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-auto">
            <button wire:click="cambiarSemana(-1)" class="btn shadow" style="background-color: #17B1DC; color: white;" aria-label="Semana Anterior">
                &laquo; Semana Anterior
            </button>
        </div>
        <div class="col-auto">
            <h5 class="text-center mb-0" style="color: #000000;">
                {{ $inicioSemana->format('d M, Y') }} - {{ $finSemana->format('d M, Y') }}
            </h5>
        </div>
        <div class="col-auto">
            <button wire:click="cambiarSemana(1)" class="btn shadow" style="background-color: #17B1DC; color: white;" aria-label="Semana Siguiente">
                Semana Siguiente &raquo;
            </button>
        </div>
    </div>

    <!-- Botón para ver citas del día -->
    <div class="d-flex justify-content-end mb-4">
        <button wire:click="$dispatch('mostrar-diario')" class="btn shadow" style="background-color: #8F5499; color: white;" aria-label="Ver citas del día">
            Ver Citas del Día
        </button>
    </div>

    <!-- Tabla de calendario semanal -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead style="background-color: #17B1DC; color: white;">
                <tr>
                    @php
                        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                    @endphp
                    @foreach ($diasSemana as $index => $dia)
                        <th>
                            <div>{{ $dia }}</div>
                            <div class="small" style="color: {{ $index >= 5 ? '#8F5499' : '#FFFFFF' }};">
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
                    @foreach ($dias as $index => $dia)
                        <td style="background-color: {{ $index >= 5 ? '#F7EDF9' : '#E3F6FB' }};">
                            @if (isset($citasPorDia[$dia]))
                                @foreach ($citasPorDia[$dia] as $cita)
                                    <a href="{{ route('citas.show', $cita['cita_id']) }}" 
                                       class="text-decoration-none d-block mb-2 p-3 border rounded shadow-sm"
                                       style="background-color: #ffffff; border-color: #17B1DC; color: #17B1DC;">
                                        <strong class="d-block">{{ $cita['hora_inicio'] }} - {{ $cita['hora_final'] }}</strong>
                                        <span class="d-block">{{ $cita['tipo_cita'] }}</span>
                                        <small class="text-muted d-block">Paciente: {{ $cita['paciente'] }}</small>
                                        <small class="text-muted d-block">Doctor: {{ $cita['doctor'] }}</small>
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
