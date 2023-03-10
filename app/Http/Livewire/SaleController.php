<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;

class SaleController extends Component
{
    public $singleSale;

    public function mount(){
        $this->singleSale = new Sale();
    }
    public function render()
    {
        return view('livewire.sale-controller', [
            'sales' => Sale::with('products')->get(),
        ])->extends('layouts.app')->section('content');
    }
    public function showSaleById($id)
    {
        $this->singleSale = Sale::findOrFail($id);
        // dd($this->singleSale->products);
        $this->dispatchBrowserEvent('showSaleModal');
    }
    public function closeModal()
    {
        $this->singleSale = new Sale();
        $this->dispatchBrowserEvent('closeModal');
    }
}
