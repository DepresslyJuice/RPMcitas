@extends('adminlte::page')

@section('title', '| Dashboard')

@section('content_header')
    <h1>CALENDARIO</h1>
@stop

@section('content')
    <div class="container">
        <h1 class="text-center">Crear Nueva Cita Médica</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('citas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="paciente_id" class="form-label">Paciente</label>
                <select name="paciente_id" id="paciente_id" class="form-control" required>
                    <option value="">Seleccione un paciente</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                            {{ $paciente->nombres }} {{ $paciente->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
            </div>

            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora Inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio') }}" required>
            </div>

            <div class="mb-3">
                <label for="hora_fin" class="form-label">Hora Fin</label>
                <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ old('hora_fin') }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="doctor_id" class="form-label">Doctor</label>
                <select name="doctor_id" id="doctor_id" class="form-control" required>
                    <option value="">Seleccione un doctor</option>
                    @foreach ($doctores as $doctor)
                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->nombres }} {{ $doctor->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tipo_cita_id" class="form-label">Tipo de Cita</label>
                <select name="tipo_cita_id" id="tipo_cita_id" class="form-control" required>
                    <option value="">Seleccione un tipo de cita</option>
                    @foreach ($tiposCita as $tipoCita)
                        <option value="{{ $tipoCita->id }}" {{ old('tipo_cita_id') == $tipoCita->id ? 'selected' : '' }}>
                            {{ $tipoCita->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="consultorio_id" class="form-label">Consultorio</label>
                <select name="consultorio_id" id="consultorio_id" class="form-control" required>
                    <option value="">Seleccione un consultorio</option>
                    @foreach ($consultorios as $consultorio)
                        <option value="{{ $consultorio->id }}" {{ old('consultorio_id') == $consultorio->id ? 'selected' : '' }}>
                            {{ $consultorio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="estado_citas_id" class="form-label">Estado de la Cita</label>
                <select name="estado_citas_id" id="estado_citas_id" class="form-control" required>
                    <option value="">Seleccione un estado</option>
                    @foreach ($estadosCitas as $estadoCita)
                        <option value="{{ $estadoCita->id }}" {{ old('estado_citas_id') == $estadoCita->id ? 'selected' : '' }}>
                            {{ $estadoCita->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Crear Cita</button>
            <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

@stop

@section('css')


@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
