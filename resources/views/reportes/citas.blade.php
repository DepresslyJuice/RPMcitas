<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid black;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<h1>Reporte de citas</h1>
@if($citas->isEmpty())
    <p>No hay citas disponibles.</p>
@else
    <table border="1">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Consultorio</th>
                <th>Tipo de Cita</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita['paciente']['nombres'] ?? 'Sin paciente' }} {{ $cita['paciente']['apellidos'] ?? '' }}</td>
                    <td>{{ $cita['doctor']['nombres'] ?? 'Sin doctor' }} {{ $cita['doctor']['apellidos'] ?? '' }}</td>
                    <td>{{ $cita['fecha'] ?? 'Sin fecha' }}</td>
                    <td>{{ $cita['hora_inicio'] ?? 'Sin hora' }}</td>
                    <td>{{ $cita['hora_fin'] ?? 'Sin hora' }}</td>
                    <td>{{ $cita['consultorio']['nombre'] ?? 'Sin consultorio' }}</td>
                    <td>{{ $cita['tipo_cita']['nombre'] ?? 'Sin tipo' }}</td>
                    <td>{{ $cita['estado_cita']['estado'] ?? 'Sin estado' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
