<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionController extends Component
{
    use WithPagination;

    public $updating_id, $destroying_id, $viewing_id;
    public $name;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.permission-controller', [
            'permisos' => Permission::paginate(5)
        ])->extends('layouts.app')->section('content');
    }
    public function updated($field)
    {
        return $this->validateOnly($field, [
            'name' => 'required|max:125|min:3|unique:permissions',
        ]);
    }
    public function onFormSubmit()
    {
        $this->validate([
            'name' => 'required|max:125|min:3|unique:permissions',
        ]);

        $new = new Permission([
            'name' => $this->name,
        ]);

        $new->save();
        session()->flash('success', 'Nuevo Permiso fue añadido!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }


    public function editPermissionById($id)
    {
        $permission = Permission::findOrFail($id);
        $this->updating_id = $permission->id;
        $this->name = $permission->name;

        $this->dispatchBrowserEvent('editPermissionModal');
    }
    public function onUpdateSubmit()
    {
        $this->validate([
            'name' => 'required|max:125|min:3',
        ]);
        $updating = Permission::findOrFail($this->updating_id);
        $updating->name = $this->name;
        $updating->save();
        session()->flash('info', 'El Permiso fue modificado!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }


    public function deletePermissionById($id)
    {
        $this->destroying_id = $id;
        $this->dispatchBrowserEvent('DestroyPermissionModal');
    }
    public function onDestroyClick()
    {
        $deleting = Permission::findOrFail($this->destroying_id);
        $deleting->delete();
        session()->flash('danger', 'El Permiso fue eliminado!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }

    public function showPermissionById($id)
    {
        $show = Permission::findOrFail($id);
        $this->viewing_id = $show->id;
        $this->name = $show->name;
        $this->dispatchBrowserEvent('showPermissionModal');
    }
    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }
}
