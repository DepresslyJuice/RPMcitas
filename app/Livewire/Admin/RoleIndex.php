<?php

namespace App\Livewire\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;

class RoleIndex extends Component
{
    public $search = '';
    public $selectedRole = null;
    public $newRoleName = '';
    public $selectedPermissions = [];
    public $isCreateModalOpen = false;
    public $roleToDelete = null; // Variable para almacenar el rol a eliminar

    protected $paginationTheme = 'bootstrap';

    public function searchRoles()
    {
        // La búsqueda se maneja con el wire:model, no es necesario código adicional aquí.
    }

    public function render()
    {
        $roles = Role::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%'])
            ->orderBy('id', 'asc')
            ->paginate(8);

        // Cargar todos los permisos disponibles
        $permissions = Permission::all();

        return view('livewire.admin.role-index', compact('roles', 'permissions'));
    }

    public function edit($roleId)
    {
        // Buscar el rol seleccionado por su ID
        $this->selectedRole = Role::find($roleId);

        if ($this->selectedRole) {
            // Cargar los permisos asignados al rol
            $this->selectedPermissions = $this->selectedRole->permissions->pluck('id')->toArray();
        }
    }

    public function update()
    {
        if ($this->selectedRole) {
            // Validar si los permisos existen
            $validPermissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('id')->toArray();

            if (count($validPermissions) != count($this->selectedPermissions)) {
                session()->flash('message', 'Algunos permisos no existen.');
                return;
            }

            // Actualizar el nombre del rol
            $this->selectedRole->name = $this->selectedRole->name;

            // Sincronizar los permisos seleccionados
            $this->selectedRole->syncPermissions($validPermissions);

            // Guardar los cambios
            $this->selectedRole->save();

            session()->flash('message', 'Rol actualizado correctamente.');

            // Cerrar el modal
            $this->closeModal();
        }
    }

    public function createRole()
    {
        $this->validate([
            'newRoleName' => 'required|string|max:255',
            'selectedPermissions' => 'array',
        ]);

        // Crear el rol
        $role = Role::create(['name' => $this->newRoleName]);

        // Sincronizar los permisos seleccionados
        if ($this->selectedPermissions) {
            $role->syncPermissions($this->selectedPermissions);
        }

        session()->flash('message', 'Rol creado correctamente.');

        // Cerrar el modal de creación
        $this->closeCreateModal();
    }

    public function openCreateModal()
    {
        // Abrir el modal de creación
        $this->isCreateModalOpen = true;
    }

    public function closeCreateModal()
    {
        // Cerrar el modal de creación y limpiar campos
        $this->isCreateModalOpen = false;
        $this->newRoleName = '';
        $this->selectedPermissions = [];
    }

    public function closeModal()
    {
        // Cerrar el modal de edición
        $this->selectedRole = null;
        $this->selectedPermissions = [];
    }


    // Método para eliminar el rol
    public function deleteRole()
    {
        if ($this->roleToDelete) {
            $role = Role::find($this->roleToDelete);

            if ($role) {
                $role->delete();
                session()->flash('message', 'Rol eliminado correctamente.');
            }

            $this->roleToDelete = null;
            $this->closeDeleteModal();
        }
    }

    // Método para confirmar la eliminación
    public function confirmDelete($roleId)
    {
        $this->roleToDelete = $roleId;
        // Puedes abrir un modal aquí si lo deseas
    }

    // Método para cerrar el modal de eliminación
    public function closeDeleteModal()
    {
        $this->roleToDelete = null;
    }
}
