<div id="calendario-diario" class="container py-4">
    <h1 class="text-center mb-4" style="color: #000000;">Citas del Día: {{ \Carbon\Carbon::parse($fecha)->format('d M, Y') }}</h1>

    <button wire:click="$dispatch('mostrar-semanal')" class="btn shadow" style="background-color: #8F5499; color: white;" aria-label="Volver a Calendario Semanal">
        Volver a Calendario Semanal
    </button>
    
    {{-- Formulario para cambiar la fecha --}}
    <form wire:submit.prevent="actualizarFecha" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <input type="date" wire:model="fecha" class="form-control" value="{{ $fecha }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn shadow" style="background-color: #17B1DC; color: white;">Ver Citas</button>
            </div>
        </div>
    </form>

    @if (empty($citas))
        <div class="alert alert-warning text-center">
            No hay citas para este día.
        </div>
    @else
        {{-- Tabla de citas del día --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead style="background-color: #17B1DC; color: white;">
                    <tr>
                        <th>Hora Inicio</th>
                        <th>Hora Final</th>
                        <th>Descripción</th>
                        <th>Paciente</th>
                        <th>Doctor</th>
                    </tr>
                </thead>
                <tbody style="background-color: #F7EDF9;">
                    @foreach ($citas as $cita)
                        <tr style="background-color: #FFFFFF; border-color: #17B1DC;">
                            <td>{{ $cita['hora_inicio'] }}</td>
                            <td>{{ $cita['hora_final'] }}</td>
                            <td>{{ $cita['descripcion'] }}</td>
                            <td>{{ $cita['paciente'] }}</td>
                            <td>{{ $cita['doctor'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
