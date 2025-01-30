<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedUser = null;
    public $selectedRoles = [];

    protected $paginationTheme = 'bootstrap';

    // Método para ejecutar la búsqueda cuando el botón sea presionado
    public function searchUsers()
    {
        // No es necesario hacer nada aquí porque la búsqueda se maneja
        // automáticamente con el wire:model y el componente renderiza los resultados
        // en base a $search
    }

    public function render()
    {
        // Realiza la búsqueda cuando el input tiene algo escrito
        $users = User::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%'])
            ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($this->search) . '%'])
            ->orderBy('id', 'asc')
            ->paginate(8);

        $roles = Role::all();
        $idUserActual = Auth::user()->id;

        return view('livewire.admin.user-index', compact('users', 'roles','idUserActual'));
    }

    public function edit($userId)
    {
        $this->selectedUser = User::find($userId);

        if ($this->selectedUser) {
            $this->selectedRoles = $this->selectedUser->roles->pluck('id')->toArray();
        }
    }

    public function update()
    {
        if ($this->selectedUser) {
            // Actualizar roles del usuario
            $user = User::find($this->selectedUser->id);
            $user->roles()->sync($this->selectedRoles);

            session()->flash('message', 'Usuario actualizado correctamente.');

            // Cerrar el modal
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        $this->selectedUser = null;
        $this->selectedRoles = [];
    }
}
