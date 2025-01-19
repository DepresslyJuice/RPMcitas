<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function searchUsers()
    {
        // No es necesario hacer nada aquí para la búsqueda
        // El componente automáticamente manejará la búsqueda
    }


    public function render()
    {

        $users = User::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%'])
        ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($this->search) . '%'])
        ->paginate(8);

        return view('livewire.admin.user-index', compact('users'));
    }
}
