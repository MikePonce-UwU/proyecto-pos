<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;

class POSController extends Component
{
    public $saleProducts = [];

    public $cliente_nombre, $cliente_cedula, $cliente_telefono, $total_venta = 0, $iva = 0, $total = 0, $vuelto = 0, $paga_con_cordobas = 0, $paga_con_dolares = 0, $pagando_con_cordobas = true, $pagando_con_dolares = false;

    // public function mount(){
    //     $this->saleProducts = ['product_id' => '', 'quantity' => 1];
    // }
    public function render()
    {
        return view('livewire.pos-controller', ['products' => Product::where('cantidad', '>', 1)->get()])->extends('layouts.app')->section('content');
    }

    public function totalPagadoCordobas()
    {
        if ($this->vuelto < 0) {
            $this->paga_con_cordobas = -$this->vuelto;
            $this->updatedPagaConCordobas();
        } else if($this->vuelto == 0) return;
    }
    public function totalPagadoDolares()
    {
        if ($this->vuelto < 0) {
            $this->paga_con_dolares = -$this->vuelto/36.5;
            $this->updatedPagaConDolares();
        } else if($this->vuelto == 0) return;
    }
    // public function updatedPagandoConCordobas(){
    //     $this->pagando_con_dolares = false;
    // }
    // public function updatedPagandoConDolares(){
    //     $this->pagando_con_cordobas = false;
    // }
    public function updatedSaleProducts()
    {
        $this->total_venta = 0;
        $this->iva = 0;
        $this->total = 0;
        foreach ($this->saleProducts as $prod) {
            $p = Product::find($prod['product_id']);
            $this->total_venta += ($p->precio_sin_iva * $prod['quantity']);
        };
        $this->iva = $this->total_venta * 0.15;
        $this->total = $this->total_venta + $this->iva;
        $this->updatedPagaConCordobas();
        $this->updatedPagaConDolares();
    }

    public function updatedPagaConCordobas()
    {
        if ($this->paga_con_cordobas == null) $this->paga_con_cordobas = 0;
        if ($this->paga_con_dolares != 0)
            $this->vuelto = - ($this->paga_con_cordobas + (($this->paga_con_dolares * 36.5) - ($this->total))) * -1;
        else
            $this->vuelto = $this->paga_con_cordobas - ($this->total);
    }
    public function updatedPagaConDolares()
    {
        if ($this->paga_con_dolares == null) $this->paga_con_dolares = 0;
        $this->vuelto = ($this->paga_con_dolares * 36.5) - ($this->total);
    }
    public function addProduct()
    {
        $this->saleProducts[] = ['product_id' => '', 'quantity' => 1];
    }

    public function removeProduct($index)
    {
        unset($this->saleProducts[$index]);
        $this->saleProducts = array_values($this->saleProducts);
        $this->updatedSaleProducts();
        // $this->updatedPagaConCordobas();
        // $this->updatedPagaConDolares();
    }

    public function saveSale()
    {
        // $total_venta = 0;
        if ($this->vuelto < 0) {
            session()->flash('error', 'El cliente aún debe C$ ' . number_format($this->vuelto, 2) . '!!!');
        } else {
            $this->validate([
                'cliente_nombre' => 'required',
                'cliente_cedula' => 'required',
                'cliente_telefono' => 'required',
            ]);
            $newSale = Sale::create([
                'cliente_nombre' => $this->cliente_nombre,
                'cliente_cedula' => $this->cliente_cedula,
                'cliente_telefono' => $this->cliente_telefono,
                'user_id' => auth()->id(),
                'total_venta' => 0,
            ]);
            foreach ($this->saleProducts as $producto) {
                $product = Product::findOrFail($producto['product_id']);
                $product->cantidad = $product->cantidad - $producto['quantity'];
                // $subtotal = $product->precio_sin_iva * $producto['quantity'];
                // $total_venta += $subtotal;
                $product->save();
                $newSale->products()->attach($producto['product_id'], ['cantidad' => $producto['quantity']]);
            }
            $newSale->total_venta = $this->total;
            $newSale->save();

            session()->flash(key: 'message', value: 'Nueva orden fue añadida! Su cambio es de C$    ' . number_format($this->vuelto, 2));
            $this->reset();
            // $this->emit('notify', 'Nueva orden fue añadida!!!');
        }
    }
}
