@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center">Editar Cita Médica</h2>
        </div>
        
        <div class="card-body">
            {{-- Mostrar errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('citas.update', $cita->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Información principal --}}
                <h5 class="mb-3">Información de la Cita</h5>
                <div class="row g-3">
                    {{-- Paciente --}}
                    <div class="col-md-6">
                        <label for="paciente_id" class="form-label">Paciente</label>
                        <select id="paciente_id" name="paciente_id" class="form-select" required>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->cedula }}" 
                                    {{ $cita->paciente_id == $paciente->cedula ? 'selected' : '' }}>
                                    {{ $paciente->cedula }} - {{ $paciente->nombres }} {{ $paciente->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Doctor --}}
                    <div class="col-md-6">
                        <label for="doctor_id" class="form-label">Doctor</label>
                        <select id="doctor_id" name="doctor_id" class="form-select" required>
                            @foreach($doctores as $doctor)
                                <option value="{{ $doctor->cedula }}" 
                                    {{ $cita->doctor_id == $doctor->cedula ? 'selected' : '' }}>
                                    {{ $doctor->cedula }} - {{ $doctor->nombres }} {{ $doctor->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Detalles adicionales --}}
                <h5 class="my-4">Detalles de la Cita</h5>
                <div class="row g-3">
                    {{-- Consultorio --}}
                    <div class="col-md-4">
                        <label for="consultorio_id" class="form-label">Consultorio</label>
                        <select id="consultorio_id" name="consultorio_id" class="form-select" required>
                            @foreach($consultorios as $consultorio)
                                <option value="{{ $consultorio->id }}" 
                                    {{ $cita->consultorio_id == $consultorio->id ? 'selected' : '' }}>
                                    {{ $consultorio->nombre }} - {{ $consultorio->direccion ?? 'Sin ubicación' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tipo de cita --}}
                    <div class="col-md-4">
                        <label for="tipo_cita_id" class="form-label">Tipo de Cita</label>
                        <select id="tipo_cita_id" name="tipo_cita_id" class="form-select" required>
                            @foreach($tiposCita as $tipoCita)
                                <option value="{{ $tipoCita->id }}" 
                                    {{ $cita->tipo_cita_id == $tipoCita->id ? 'selected' : '' }}>
                                    {{ $tipoCita->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Estado --}}
                    <div class="col-md-4">
                        <label for="estado_citas_id" class="form-label">Estado</label>
                        <select id="estado_citas_id" name="estado_citas_id" class="form-select" required>
                            @foreach($estadosCita as $estadoCita)
                                <option value="{{ $estadoCita->id }}" 
                                    {{ $cita->estado_citas_id == $estadoCita->id ? 'selected' : '' }}>
                                    {{ $estadoCita->estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Fecha y hora --}}
                <div class="row g-3 mt-4">
                    <div class="col-md-4">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input id="fecha" type="date" name="fecha" class="form-control" 
                               value="{{ $cita->fecha }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="hora_inicio" class="form-label">Hora Inicio</label>
                        <input id="hora_inicio" type="time" name="hora_inicio" class="form-control" 
                               value="{{ $cita->hora_inicio }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="hora_fin" class="form-label">Hora Fin</label>
                        <input id="hora_fin" type="time" name="hora_fin" class="form-control" 
                               value="{{ $cita->hora_fin }}" required>
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="mt-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3">{{ $cita->descripcion }}</textarea>
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Cita</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
