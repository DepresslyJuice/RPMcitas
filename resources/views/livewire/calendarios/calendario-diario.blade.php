<div id="calendario-diario" class="container py-4">
    <style>
        /* Estilos personalizados */
        #calendario-diario {
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .btn {
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0e90b6 !important;
        }

        .form-label {
            font-size: 14px;
            font-weight: bold;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 5px 10px;
            font-size: 14px;
        }

        .form-select:focus, .form-control:focus {
            outline: none;
            border-color: #17B1DC;
            box-shadow: 0 0 5px #17B1DC;
        }

        .filtros-container {
            background-color: #cff5ff;
            border-radius: 10px;
            border: 1px solid #17B1DC;
            padding: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }

        .alert-warning {
            margin-top: 20px;
            background-color: #ffebcc;
            color: #996633;
            padding: 10px;
            border: 1px solid #ffa726;
            border-radius: 8px;
        }

        .cita-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .cita-card h6 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .cita-card p {
            margin: 0;
            font-size: 14px;
        }

        .cita-card span {
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .filtros-container {
                flex-direction: column;
            }

            .cita-card {
                font-size: 14px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>

    <!-- Título -->
    <h1 class="text-center mb-4">Citas del Día: {{ \Carbon\Carbon::parse($fecha)->format('d M, Y') }}</h1>

    <!-- Botón Volver a Calendario Semanal -->
    <div class="d-flex justify-content-start mb-4">
        <button wire:click="$dispatch('mostrar-semanal')" class="btn shadow-sm" style="background-color: #8F5499; color: white;">
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
    <div class="filtros-container">
        <h6 class="me-3 mb-0">Filtrar por:</h6>

        <div>
            <label for="doctor" class="form-label">Doctor:</label>
            <select id="doctor" wire:model="doctorId" class="form-select">
                <option value="">Todos los doctores</option>
                @foreach ($doctores as $doctor)
                    <option value="{{ $doctor->nombres }} {{ $doctor->apellidos }}">{{ $doctor->nombres }}
                        {{ $doctor->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="consultorio" class="form-label">Consultorio:</label>
            <select id="consultorio" wire:model="consultorioId" class="form-select">
                <option value="">Todos los consultorios</option>
                @foreach ($consultorios as $consultorio)
                    <option value="{{ $consultorio->nombre }}">{{ $consultorio->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tipoCita" class="form-label">Tipo de Cita:</label>
            <select id="tipoCita" wire:model="tipoCitaId" class="form-select">
                <option value="">Todos los tipos de citas</option>
                @foreach ($tiposCita as $tipoCita)
                    <option value="{{ $tipoCita->nombre }}">{{ $tipoCita->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button wire:click="citasDelDia" class="btn shadow-sm" style="background-color: #17B1DC; color: white;">
                Aplicar Filtros
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
</div>
