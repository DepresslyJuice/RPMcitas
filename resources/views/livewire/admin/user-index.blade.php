<div>
    <div class="card">
        <div class="card-header">
            <!-- Campo de entrada de búsqueda -->
            <input wire:model="search" class="form-control" placeholder="Buscar usuarios..." />

            <!-- Botón de búsqueda que ejecutará searchUsers -->
            <button wire:click="searchUsers" class="btn btn-primary mt-2">Buscar</button>
        </div>

        @if ($users->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <!-- Botón para abrir el modal -->
                                    <button class="btn btn-primary" wire:click="edit({{ $item->id }})">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros...</strong>
            </div>
        @endif

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($selectedUser)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="update">
                            <!-- Nombre (solo visualización) -->
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <p class="form-control-plaintext">{{ $selectedUser->name }}</p>
                            </div>

                            <!-- Email (solo visualización) -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <p class="form-control-plaintext">{{ $selectedUser->email }}</p>
                            </div>

                            <!-- Roles (checkboxes para editar) -->
                            <div class="form-group">
                                <label for="roles">Roles</label>
                                @foreach($roles as $role)
                                    <div>
                                        <input type="checkbox" wire:model="selectedRoles" value="{{ $role->id }}" class="mr-1">
                                        {{ $role->name }}
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
