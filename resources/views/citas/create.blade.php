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
                <select class="form-select select2" id="paciente_id" name="paciente_id" required>
                    <option value="" selected disabled>Buscar paciente...</option>
                </select>
            </div>

            <!-- Doctor -->
            @if (!auth()->user()->hasRole('Dentista'))
                <div class="mb-3">
                    <label for="doctor_id" class="form-label">Doctor</label>
                    <select class="form-select select2" id="doctor_id" name="doctor_id" required>
                        <option value="" selected disabled>Buscar doctor...</option>
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
                <select class="form-select select2" id="tipo_cita_id" name="tipo_cita_id" required>
                    <option value="" selected disabled>Buscar tipo de cita...</option>
                </select>
            </div>

            <!-- Consultorio -->
            <div class="mb-3">
                <label for="consultorio_id" class="form-label">Consultorio</label>
                <select class="form-select select2" id="consultorio_id" name="consultorio_id" required>
                    <option value="" selected disabled>Buscar consultorio...</option>
                </select>
            </div>

            <!-- Estado de la Cita -->
            <div class="mb-3">
                <label for="estado_citas_id" class="form-label">Estado de la Cita</label>
                <select class="form-select select2" id="estado_citas_id" name="estado_citas_id" required>
                    <option value="" selected disabled>Selecciona un estado</option>
                    @foreach ($estadosCita as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón de enviar -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
                <button type="submit" class="btn btn-primary">Crear Cita</button>
            </div>
        </form>

        @vite('resources/css/CRUDS/create.css')
    </div>
@endsection

@section('js')
    <!-- CSS y JS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            function initSelect2(selector, url, placeholder) {
                $(selector).select2({
                    placeholder: placeholder,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return { search: params.term };
                        },
                        processResults: function (data) {
                            return { results: data };
                        }
                    }
                });
            }

            initSelect2('#paciente_id', '{{ route("api.pacientes") }}', 'Buscar paciente...');
            initSelect2('#doctor_id', '{{ route("api.doctores") }}', 'Buscar doctor...');
            initSelect2('#tipo_cita_id', '{{ route("api.tipos_cita") }}', 'Buscar tipo de cita...');
            initSelect2('#consultorio_id', '{{ route("api.consultorios") }}', 'Buscar consultorio...');
        });
    </script>
@endsection
