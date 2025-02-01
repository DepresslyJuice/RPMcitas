@extends('adminlte::page')

@section('title', 'Crear Cita Médica')

@section('content')
    <div class="container">
        <h1 class="text-center">Crear Cita Médica</h1>

        <form action="{{ route('citas.store') }}" method="POST">
            @csrf

            <!-- Paciente -->
            <div class="mb-3">
                <label for="paciente_id" class="form-label">Paciente</label>
                <select class="form-select" id="paciente_id" name="paciente_id" required>
                    <option value="" selected disabled>Selecciona un paciente</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->cedula }}">{{ $paciente->nombres }} {{ $paciente->apellidos }} -
                            {{ $paciente->cedula }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Doctor -->
            @if (!auth()->user()->hasRole('Dentista'))
                <div class="mb-3">
                    <label for="doctor_id" class="form-label">Doctor</label>
                    <select class="form-select" id="doctor_id" name="doctor_id" required>
                        <option value="" selected disabled>Selecciona un doctor</option>
                        @foreach ($doctores as $doctor)
                            <option value="{{ $doctor->cedula }}">{{ $doctor->nombres }} {{ $doctor->apellidos }} -
                                {{ $doctor->cedula }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <!-- Hora Inicio -->
            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora Inicio</label>
                <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
            </div>

            <!-- Hora Fin -->
            <div class="mb-3">
                <label for="hora_fin" class="form-label">Hora Fin</label>
                <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>

            <!-- Tipo de Cita -->
            <div class="mb-3">
                <label for="tipo_cita_id" class="form-label">Tipo de Cita</label>
                <select class="form-select" id="tipo_cita_id" name="tipo_cita_id" required>
                    <option value="" selected disabled>Selecciona un tipo de cita</option>
                    @foreach ($tiposCita as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Consultorio -->
            <div class="mb-3">
                <label for="consultorio_id" class="form-label">Consultorio</label>
                <select class="form-select" id="consultorio_id" name="consultorio_id" required>
                    <option value="" selected disabled>Selecciona un consultorio</option>
                    @foreach ($consultorios as $consultorio)
                        <option value="{{ $consultorio->id }}">{{ $consultorio->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Estado de la Cita -->
            <div class="mb-3">
                <label for="estado_citas_id" class="form-label">Estado de la Cita</label>
                <select class="form-select" id="estado_citas_id" name="estado_citas_id" required>
                    <option value="" selected disabled>Selecciona un estado</option>
                    @foreach ($estadosCita as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón de enviar -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Crear Cita</button>
            </div>
        </form>
    </div>
@endsection
