<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Component
{
    use WithPagination;
    public $updating_id, $destroying_id, $viewing_id, $name, $description;
    public $search, $filter;

    protected $queryString = ['search', 'filter', 'page'];
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $categories = QueryBuilder::for(Category::where('name', 'like', '%' . $this->search . '%'))
            ->allowedSorts([
                'name',
                'description',
            ])
            ->allowedFilters([
                'name',
                'description'
            ])
            ->defaultSort('name')
            ->paginate(5)
            ->appends(request()->query());
        return view('livewire.category-controller', [
            // 'categorias' => Category::paginate(5),
            'categorias' => $categories
        ])->extends('layouts.app')->section('content');
    }
    public function updated($field)
    {
        return $this->validateOnly($field, [
            'name' => 'required|max:125|min:3|unique:categories',
            'description' => 'required|min:3|max:255'
        ]);
    }
    public function onFormSubmit()
    {
        $this->validate([
            'name' => 'required|max:125|min:3|unique:categories',
            'description' => 'required|min:3|max:255'
        ]);

        $new = new Category([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $new->save();
        session()->flash('success', 'Nueva categoría fue añadida!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }


    public function editCategoryById($id): void
    {
        $category = Category::findOrFail($id);
        $this->updating_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;

        $this->dispatchBrowserEvent('openEditModal');
    }
    public function onUpdateSubmit()
    {
        $this->validate([
            'name' => 'required|max:125|min:3',
            'description' => 'required|min:3|max:255'
        ]);
        $updating = Category::findOrFail($this->updating_id);
        $updating->name = $this->name;
        $updating->description = $this->description;
        $updating->save();
        session()->flash('info', 'La categoría fue modificada!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }


    public function deleteCategoryById($id)
    {
        $this->destroying_id = $id;
        $this->dispatchBrowserEvent('DestroyCategoryModal');
    }
    public function onDestroyClick()
    {
        $deleting = Category::findOrFail($this->destroying_id);
        $deleting->delete();
        session()->flash('danger', 'La categoría fue Eliminada!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }

    public function showCategoryById($id)
    {
        $show = Category::findOrFail($id);
        $this->viewing_id = $show->id;
        $this->name = $show->name;
        $this->description = $show->description;
        $this->dispatchBrowserEvent('showCategoryModal');
    }
    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }
}
