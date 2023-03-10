<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductController extends Component
{
    use WithPagination;

    public $updating_id, $destroying_id, $viewing_id;
    public $nombre, $descripcion, $cantidad, $precio_anterior, $precio_sin_iva, $category_id;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatedPrecioAnterior($value){
        $this->precio_sin_iva = $value / 1.15;
    }
    public function render()
    {
        return view('livewire.product-controller', [
            'productos' => Product::paginate(5),
            'categorias' => Category::all()->pluck(value: 'name', key: 'id')
        ])->extends('layouts.app')->section('content');
    }

    public function onFormSubmit()
    {
        $this->validate([
            'nombre' => 'required|max:125|min:3',
            'descripcion' => 'required|max:125|min:3',
            'cantidad' => 'required|integer',
            'precio_anterior' => 'required|numeric',
            'precio_sin_iva' => 'required|numeric',
        ]);

        $new = new Product([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'cantidad' => $this->cantidad,
            'precio_anterior' => $this->precio_anterior,
            'precio_sin_iva' => $this->precio_sin_iva,
            'category_id' => $this->category_id,
        ]);
        $new->save();
        session()->flash('success', 'Nuevo Ítem fue añadido!!');
        $this->closeModal();
    }

    public function editProductById($id)
    {
        $product = Product::findOrFail($id);
        $this->updating_id = $product->id;
        $this->nombre = $product->nombre;
        $this->descripcion = $product->descripcion;
        $this->cantidad = $product->cantidad;
        $this->precio_anterior = $product->precio_anterior;
        $this->precio_sin_iva = $product->precio_sin_iva;
        $this->category_id = $product->category_id;
        $this->dispatchBrowserEvent('openEditModal');
    }

    public function onUpdateSubmit()
    {
        $this->validate([
            'nombre' => 'required|max:125|min:3',
            'descripcion' => 'required|max:125|min:3',
            'cantidad' => 'required|integer',
            'precio_anterior' => 'required|numeric',
            'precio_sin_iva' => 'required|numeric',
        ]);
        $updating = Product::findOrFail($this->updating_id);
        $updating->nombre = $this->nombre;
        $updating->descripcion = $this->descripcion;
        $updating->cantidad = $this->cantidad;
        $updating->precio_anterior = $this->precio_anterior;
        $updating->precio_sin_iva = $this->precio_sin_iva;
        $updating->category_id = $this->category_id;
        $updating->save();
        session()->flash('info', 'El Ítem fue modificado!!');
        $this->closeModal();
    }

    public function deleteProductById($id)
    {
        $this->destroying_id = $id;
        $this->dispatchBrowserEvent('DestroyProductModal');
    }

    public function onDestroyClick()
    {
        $deleting = Product::findOrFail($this->destroying_id);
        $deleting->delete();
        session()->flash('danger', 'El Ítem fue eliminado!!');
        $this->closeModal();
    }

    public function showProductById($id)
    {
        $show = Product::findOrFail($id);
        $this->viewing_id = $show->id;
        $this->nombre = $show->nombre;
        $this->descripcion = $show->descripcion;
        $this->cantidad = $show->cantidad;
        $this->precio_anterior = $show->precio_anterior;
        $this->precio_sin_iva = $show->precio_sin_iva;
        $this->category_id = $show->category_id;
        $this->dispatchBrowserEvent('showProductModal');
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }
}
