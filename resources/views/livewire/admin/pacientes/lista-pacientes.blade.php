<div>
    <h2 class="text-lg font-bold mb-4">Gestión de Pacientes</h2>
    
    <!-- Formulario para agregar o editar pacientes -->
    <form wire:submit.prevent="guardarPaciente" class="mb-4">
        <div class="grid grid-cols-2 gap-4">
            <input type="text" wire:model="cedula" placeholder="Cédula" class="border p-2 w-full">
            <input type="text" wire:model="nombre" placeholder="Nombre" class="border p-2 w-full">
            <input type="text" wire:model="apellido" placeholder="Apellido" class="border p-2 w-full">
            <input type="text" wire:model="telefono" placeholder="Teléfono" class="border p-2 w-full">
            <input type="email" wire:model="email" placeholder="Correo Electrónico" class="border p-2 w-full">
        </div>
        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2">{{ $editando ? 'Actualizar' : 'Agregar' }}</button>
    </form>

    <!-- Tabla de pacientes -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Cédula</th>
                <th class="border p-2">Nombre</th>
                <th class="border p-2">Apellido</th>
                <th class="border p-2">Teléfono</th>
                <th class="border p-2">Correo</th>
                <th class="border p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                <tr class="border">
                    <td class="border p-2">{{ $paciente->cedula }}</td>
                    <td class="border p-2">{{ $paciente->nombre }}</td>
                    <td class="border p-2">{{ $paciente->apellido }}</td>
                    <td class="border p-2">{{ $paciente->telefono }}</td>
                    <td class="border p-2">{{ $paciente->email }}</td>
                    <td class="border p-2">
                        <button wire:click="editarPaciente({{ $paciente->id }})" class="bg-yellow-500 text-white px-2 py-1">Editar</button>
                        <button wire:click="eliminarPaciente({{ $paciente->id }})" class="bg-red-500 text-white px-2 py-1" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
