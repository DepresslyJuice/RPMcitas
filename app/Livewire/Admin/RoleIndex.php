<?php

namespace App\Livewire\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;

class RoleIndex extends Component
{
    public $search = '';
    public $selectedRole = null;
    public $selectedPermissions = [];

    protected $paginationTheme = 'bootstrap';

    public function searchRoles()
    {
        // No es necesario hacer nada aquí, ya que la búsqueda se maneja con el wire:model
    }

    public function render()
    {
        // Realiza la búsqueda cuando el input tiene algo escrito
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
    
    

    public function closeModal()
    {
        $this->selectedRole = null;
        $this->selectedPermissions = [];
    }
}
