<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Doctores</title>
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
</head>
<body>
    <h1>Reporte de Doctores</h1>
    <table>
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Especialidades</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctores as $doctor)
                <tr>
                    <td>{{ $doctor->cedula }}</td>
                    <td>{{ $doctor->nombres }} {{ $doctor->apellidos }}</td>
                    <td>{{ $doctor->telefono }}</td>
                    <td>{{ $doctor->email }}</td>
                    <td>
                        @foreach($doctor->especialidades as $especialidad)
                            {{ $especialidad->nombre }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
