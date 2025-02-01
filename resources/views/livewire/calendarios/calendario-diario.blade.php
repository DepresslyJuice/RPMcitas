<div id="calendario-diario" class="container py-4">

    <!-- Título -->
    <h1 class="text-center mb-4">Citas del Día: {{ \Carbon\Carbon::parse($fecha)->format('d M, Y') }}</h1>

    <!-- Botón Volver a Calendario Semanal -->
    <div class="d-flex justify-content-start mb-4">
        <button wire:click="$dispatch('mostrar-semanal')" class="btn shadow-sm"
            style="background-color: #8F5499; color: white;">
            Volver a Calendario Semanal
        </button>
    </div>

    <!-- Formulario para cambiar la fecha -->
    <form wire:submit.prevent="actualizarFecha" class="row align-items-center mb-4 g-3">
        <div class="col-md-4">
            <label for="fecha" class="form-label">Seleccionar Fecha:</label>
            <input id="fecha" type="date" wire:model="fecha" class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn shadow-sm" style="background-color: #17B1DC; color: white;">
                Ver Citas
            </button>
        </div>
    </form>

    <!-- Filtros -->
    <div class="d-flex flex-wrap align-items-center mb-6"
        style="background-color: #cff5ff; padding: 10px; border-radius: 10px;
border-color: #17B1DC;">
        <h6>Filtrar por:</h6>

        @if (!auth()->user()->hasRole('Dentista'))
            <div class="col-md-3 col-sm-6 mb-3">
                <!-- Filtro de Doctor -->
                <h6>Doctor:</h6>
                <select wire:model="doctorId" class="form-select"
                    style="border-radius: 8px; border: 1px solid #17B1DC; padding: 8px; background-color: #f9fcff;">
                    <option value="">Todos los doctores</option>
                    @foreach ($doctores as $doctor)
                        <option value="{{ $doctor->cedula }}">{{ $doctor->nombres }}
                            {{ $doctor->apellidos }} - {{ $doctor->cedula }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="col-md-3 col-sm-6 mb-3">
            <!-- Filtro de Consultorio -->
            <h6>Consultorio:</h6>
            <select wire:model="consultorioId" class="form-select"
                style="border-radius: 8px; border: 1px solid #17B1DC; padding: 8px; background-color: #f9fcff;">
                <option value="">Todos los consultorios</option>
                @foreach ($consultorios as $consultorio)
                    <option value="{{ $consultorio->nombre }}">{{ $consultorio->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <!-- Filtro de Tipo de Cita -->
            <h6>Tipo Cita:</h6>
            <select wire:model="tipoCitaId" class="form-select"
                style="border-radius: 8px; border: 1px solid #17B1DC; padding: 8px; background-color: #f9fcff;">
                <option value="">Todos los tipos de citas</option>
                @foreach ($tiposCita as $tipoCita)
                    <option value="{{ $tipoCita->nombre }}">{{ $tipoCita->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto mb-3">
            <!-- Botón para aplicar filtros -->
            <button wire:click="actualizarFecha" class="btn shadow" style="background-color: #17B1DC; color: white;">
                Aplicar Filtros
            </button>
        </div>

        <!-- Botón para cambiar a vista semanal -->
        <div class="col-auto mb-3">
            <button wire:click="$dispatch('mostrar-semanal')" class="btn shadow"
                style="background-color: #8F5499; color: white;" aria-label="Ver citas semanales">
                Semana
            </button>
        </div>
    </div>
    <!-- Tarjetas de citas -->
    @if (empty($citas))
        <div class="alert alert-warning text-center">
            No hay citas para este día.
        </div>
    @else
        <div class="mt-4">
            @foreach ($citas as $cita)
                <div class="cita-card">
                    <h6>Paciente: <span>{{ $cita['paciente'] }}</span></h6>
                    <p><span>Doctor:</span> {{ $cita['doctor'] }}</p>
                    <p><span>Tipo de Cita:</span> {{ $cita['tipo_cita'] }}</p>
                    <p><span>Hora:</span> {{ $cita['hora_inicio'] }} - {{ $cita['hora_final'] }}</p>
                    <p><span>Descripción:</span> {{ $cita['descripcion'] }}</p>
                    <p><span>Consultorio:</span> {{ $cita['consultorio'] }}</p>
                </div>
            @endforeach
        </div>
    @endif
    @vite('resources/css/calendario/calendario_diario.css')
</div>
