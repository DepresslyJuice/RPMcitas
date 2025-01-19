<div>
    <div class="card">
        <div class="card-header">
            <!-- Campo de entrada de búsqueda -->
            <input wire:model="search" class="form-control" placeholder="Buscar roles..." />

            <!-- Botón de búsqueda -->
            <button wire:click="searchRoles" class="btn btn-primary mt-2">Buscar</button>
        </div>

        @if ($roles->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <!-- Botón para abrir el modal -->
                                    <button class="btn btn-primary" wire:click="edit({{ $role->id }})">
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
            {{ $roles->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($selectedRole)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Rol</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="update">
                            <!-- Nombre del rol -->
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" id="name" class="form-control" value="{{ $selectedRole->name }}" />
                            </div>
                            
                            <!-- Permisos (checkboxes para editar) -->
                            <div class="form-group">
                                <label for="permissions">Permisos</label>
                                @foreach($permissions as $permission)
                                    <div>
                                        <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}" class="mr-1">
                                        {{ $permission->name }}
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
