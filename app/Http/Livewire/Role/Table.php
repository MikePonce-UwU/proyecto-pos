<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;

class Table extends Component
{
    public $roles;
    public function mount($roles){
        $this->roles = $roles;
    }
    public function render()
    {
        return view('livewire.role.table');
    }
}
