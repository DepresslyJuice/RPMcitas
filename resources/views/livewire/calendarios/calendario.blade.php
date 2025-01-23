<div>
    {{-- CALENDARIO SEMANAL --}}

    <div id="calendario-semanal" class="container">
        <h1 class="text-center">Agenda Semanal</h1>
        <div class="d-flex justify-content-between mb-3">
            <!-- Botón para la semana anterior -->
            <button wire:click="cambiarSemana(-1)" class="btn btn-primary">Semana Anterior</button>

            <!-- Mostrar rango de la semana actual -->
            <h5>{{ $inicioSemana->format('d M, Y') }} - {{ $finSemana->format('d M, Y') }}</h5>

            <!-- Botón para la semana siguiente -->
            <button wire:click="cambiarSemana(1)" class="btn btn-primary">Semana Siguiente</button>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <button id="ver-citas-dia" class="btn btn-info">
                Ver Citas del Día
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sábado</th>
                        <th>Domingo</th>
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
                                        <div class="mb-3 p-2 border rounded bg-light">
                                            {{-- <strong>{{ $cita->hora_inicio }} - {{ $cita->hora_final }}</strong><br>
                                            <span>{{ $cita->descripcion }}</span><br>
                                            <small>Paciente: {{ $cita->paciente }}</small><br>
                                            <small>Doctor: {{ $cita->doctor }}</small>
                                            <br>
                                            <small>Consultorio: {{ $cita->consultorio }}</small> --}}

                                            <strong>{{ $cita['hora_inicio'] }} - {{ $cita['hora_final'] }}</strong><br>
                                            <span>{{ $cita['descripcion'] }}</span><br>
                                            <small>Paciente: {{ $cita['paciente'] }}</small><br>
                                            <small>Doctor: {{ $cita['doctor'] }}</small>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No hay citas</p>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>




    {{-- CALENDARIO POR DIA --}}
    <div id="calendario-dia" class="container" style="display: none;">
        <h1 class="text-center">Citas del Día: {{ \Carbon\Carbon::parse($fecha)->format('d M, Y') }}</h1>

        @if (!isset($citas))
        
            <div class="alert alert-warning text-center">
                No hay citas para este día.
            </div>
        @else
            <form wire:submit.prevent="actualizarFecha" class="mb-3">
                <div class="input-group">
                    <input type="date" wire:model="fecha" class="form-control" value="{{ $fecha }}">
                    <button id="ver-citas" type="submit" class="btn btn-success">Ver Citas</button>
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
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
        @endif

        <div class="d-flex justify-content-end">
            <button id="volver-agenda-semanal" class="btn btn-primary">Volver a la Agenda Semanal</button>
        </div>
    </div>
</div>

<script>
    // Esperar a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', () => {
        const calendarioSemanal = document.getElementById('calendario-semanal');
        const calendarioDia = document.getElementById('calendario-dia');

        const btnVerCitasDia = document.getElementById('ver-citas-dia');
        const btnVolverAgendaSemanal = document.getElementById('volver-agenda-semanal');

        // Mostrar calendario diario y ocultar el semanal
        btnVerCitasDia.addEventListener('click', () => {
            calendarioSemanal.style.display = 'none';
            calendarioDia.style.display = 'block';
        });

        // Volver al calendario semanal y ocultar el diario
        btnVolverAgendaSemanal.addEventListener('click', () => {
            calendarioDia.style.display = 'none';
            calendarioSemanal.style.display = 'block';
        });
    });
</script>
<script>
    // Esperar a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', () => {
        const calendarioSemanal = document.getElementById('calendario-semanal');
        const calendarioDia = document.getElementById('calendario-dia');

        const btnVerCitasDia = document.getElementById('ver-citas-dia');
        const btnVolverAgendaSemanal = document.getElementById('volver-agenda-semanal');
        const verCitas = document.getElementById('verCitas');
        // Mostrar calendario diario y ocultar el semanal
        verCitas.addEventListener('click', () => {
            calendarioSemanal.style.display = 'none';
            calendarioDia.style.display = 'block';
        });

        // Mostrar calendario diario y ocultar el semanal
        btnVerCitasDia.addEventListener('click', () => {
            calendarioSemanal.style.display = 'none';
            calendarioDia.style.display = 'block';
        });

        // Volver al calendario semanal y ocultar el diario
        btnVolverAgendaSemanal.addEventListener('click', () => {
            calendarioDia.style.display = 'none';
            calendarioSemanal.style.display = 'block';
        });
    });
</script>
