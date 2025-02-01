<div>
    <div class="card">
        <div class="card-header">
            <!-- Campo de entrada de búsqueda -->
            <input wire:model="search" class="form-control" placeholder="Buscar roles..." />

            <!-- Botón de búsqueda -->
            <button wire:click="searchRoles" class="btn btn-primary mt-2">Buscar</button>

            <!-- Botón para abrir el modal de creación de rol -->
            <button wire:click="openCreateModal" class="btn btn-success mt-2 float-right">Crear Nuevo Rol</button>
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
                                    <button class="btn btn-primary" wire:click="edit({{ $role->id }})">
                                        Editar
                                    </button>
                                    <button class="btn btn-danger"
                                        wire:click="confirmDelete({{ $role->id }})">Eliminar</button>

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

    <!-- Modal de Creación de Rol -->
    @if ($isCreateModalOpen)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Nuevo Rol</h5>
                        <button type="button" class="btn-close" wire:click="closeCreateModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="createRole">
                            <!-- Nombre del rol -->
                            <div class="form-group">
                                <label for="newRoleName">Nombre del Rol</label>
                                <input type="text" id="newRoleName" wire:model="newRoleName" class="form-control"
                                    required />
                            </div>

                            <!-- Permisos (checkboxes para seleccionar) -->
                            <div class="form-group">
                                <label for="permissions">Permisos</label>
                                @foreach ($permissions as $permission)
                                    <div>
                                        <input type="checkbox" wire:model="selectedPermissions"
                                            value="{{ $permission->id }}" class="mr-1">
                                        {{ $permission->name }}
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">Crear Rol</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeCreateModal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Edición de Rol (ya existe en tu código original) -->
    @if ($selectedRole)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Rol</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="update">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" id="name" wire:model="selectedRole.name"
                                    class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="permissions">Permisos</label>
                                @foreach ($permissions as $permission)
                                    <div>
                                        <input type="checkbox" wire:model="selectedPermissions"
                                            value="{{ $permission->id }}" class="mr-1">
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

    <!-- Modal de confirmación de eliminación -->
    @if ($roleToDelete)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close" wire:click="closeDeleteModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar este rol?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeDeleteModal">Cancelar</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteRole">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
        
</div>
