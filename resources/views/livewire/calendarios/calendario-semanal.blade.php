<div id="calendario-semanal" class="container py-4">
    <h1 class="text-center mb-4" style="color: #000000;">Agenda Semanal</h1>

    <!-- Controles de semana -->
    <div class="row justify-content-center align-items-center mb-4">
        <div class="col-auto">
            <button wire:click="cambiarSemana(-1)" class="btn shadow" style="background-color: #17B1DC; color: white;"
                aria-label="Semana Anterior">
                &laquo; Anterior
            </button>
        </div>
        <div class="col-auto">
            <h3 class="text-center mb-0" style="color: #000000;">
                {{ $inicioSemana->format('d M, Y') }} - {{ $finSemana->format('d M, Y') }}
            </h3>
        </div>
        <div class="col-auto">
            <button wire:click="cambiarSemana(1)" class="btn shadow" style="background-color: #17B1DC; color: white;"
                aria-label="Semana Siguiente">
                Siguiente &raquo;
            </button>
        </div>
    </div>
    <!-- Filtros -->
    <div class="d-flex flex-wrap align-items-center mb-6" style="background-color: #cff5ff; padding: 10px; border-radius: 10px;
    border-color: #17B1DC;">
        <h6>Filtrar por:</h6>
        <div class="col-md-3 col-sm-6 mb-3">
            <!-- Filtro de Doctor -->
            <h6>Doctor:</h6>
            <select wire:model="doctorId" class="form-select">
                <option value="">Todos los doctores</option>
                @foreach ($doctores as $doctor)
                    <option value="{{ $doctor->nombres }} {{ $doctor->apellidos }}">{{ $doctor->nombres }}
                        {{ $doctor->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 col-sm-6 mb-3" >
            <!-- Filtro de Consultorio -->
            <h6>Consultorio:</h6>
            <select wire:model="consultorioId" class="form-select">
                <option value="">Todos los consultorios</option>
                @foreach ($consultorios as $consultorio)
                    <option value="{{ $consultorio->nombre }}">{{ $consultorio->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <!-- Filtro de Tipo de Cita -->
            <h6>Tipo Cita:</h6>
            <select wire:model="tipoCitaId" class="form-select">
                <option value="">Todos los tipos de citas</option>
                @foreach ($tiposCita as $tipoCita)
                    <option value="{{ $tipoCita->nombre }}">{{ $tipoCita->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto mb-3">
            <!-- Botón para aplicar filtros -->
            <button wire:click="aplicarFiltros" class="btn shadow" style="background-color: #17B1DC; color: white;">
                Aplicar Filtros
            </button>
        </div>

        <!-- Botón para ver citas del día -->
        <div class="col-auto mb-3">
            <button wire:click="$dispatch('mostrar-diario')" class="btn shadow"
                style="background-color: #8F5499; color: white;" aria-label="Ver citas del día">
                Día
            </button>
        </div>
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
                        <td style="background-color: {{ $index >= 5 ? '#F7EDF9' : '#E3F6FB' }};"
                            data-label="{{ $diasSemana[$index] }}">
                            @if (isset($citasPorDia[$dia]))
                                @foreach ($citasPorDia[$dia] as $cita)
                                    <a href="{{ route('citas.show', $cita['cita_id']) }}"
                                        class="text-decoration-none d-block mb-2 p-3 border rounded shadow-sm"
                                        style="background-color: #ffffff; border-color: #17B1DC; color: #17B1DC;">
                                        <strong class="d-block">{{ $cita['hora_inicio'] }} -
                                            {{ $cita['hora_final'] }}</strong>
                                        <span class="d-block">{{ $cita['tipo_cita'] }}</span>
                                        <small class="text-muted d-block">Paciente: {{ $cita['paciente'] }}</small>
                                        <small class="text-muted d-block">Doctor: {{ $cita['doctor'] }}</small>
                                        <small class="text-muted d-block"> {{ $cita['consultorio'] }}</small>
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
    <style>
        @media (max-width: 800px) {
            .table thead {
                display: none;
            }

            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table td {
                padding: 15px;
                border: 1px solid #ddd;
            }

            .table td:before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
            }
            
        }
    </style>
</div>
