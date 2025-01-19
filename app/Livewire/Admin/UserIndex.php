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

    public function updatingSearch()
    {
        $this->resetPage();
    } 

    public function render()
    {
        $users = User::query();
    
        if ($this->search) {
            $users = $users->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }
    
        $users = $users->paginate(8);
    
        return view('livewire.admin.user-index', compact('users'));
    }
    
}
