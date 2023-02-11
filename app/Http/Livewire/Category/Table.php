<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;

class Table extends Component
{
    public $categorias;
    public function mount($categorias){
        $this->categorias = $categorias;
    }
    public function render()
    {
        return view('livewire.category.table');
    }
}
