<?php

namespace App\Http\Livewire\Pos;

use App\Models\Product;
use Livewire\Component;

class Total extends Component
{
    public array $orderProducts = [], $total_venta;
    public function mount($orderProducts)
    {
        $this->orderProducts = $orderProducts;
        $this->getTotalVenta();
    }
    public function render()
    {
        return view('livewire.pos.total');
    }
    public function getTotalVenta()
    {
        $int = 0;
        while($int >= count($this->orderProducts)){
            $producto = Product::find($this->orderProducts[$int]['product_id']);
            $this->total_venta += ($this->orderProducts[$int]['quantity'] * $producto->precio_sin_iva);
        }
    }
    public $listeners = ['saveOrderProducts' => 'mount'];
}
