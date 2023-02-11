<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\QueryBuilder;

class RoleController extends Component
{
    use WithPagination;

    public $updating_id, $destroying_id, $viewing_id;
    public $search;
    public $name;


    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $roles = QueryBuilder::for(Role::where('name', 'like', '%' . $this->search . '%'))
            ->allowedSorts(['name'])
             ->defaultSort('name')
            ->paginate(5)
            ->appends(request()->query());
        return view('livewire.role-controller', [
            'roles' => $roles
        ])->extends('layouts.app')->section('content');
    }
    public function updated($field)
    {
        return $this->validateOnly($field, [
            'name' => 'required|max:125|min:3|unique:roles',
        ]);
    }
    public function onFormSubmit()
    {
        $this->validate([
            'name' => 'required|max:125|min:3|unique:roles',
        ]);

        $new = new Role([
            'name' => $this->name,
        ]);

        $new->save();
        session()->flash('success', 'Nuevo Rol fue añadido!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }


    public function editRoleById($id)
    {
        $role = Role::findOrFail($id);
        $this->updating_id = $role->id;
        $this->name = $role->name;

        $this->dispatchBrowserEvent('editRoleModal');
    }
    public function onUpdateSubmit()
    {
        $this->validate([
            'name' => 'required|max:125|min:3',
        ]);
        $updating = Role::findOrFail($this->updating_id);
        $updating->name = $this->name;
        $updating->save();
        session()->flash('info', 'El Rol fue modificado!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }


    public function deleteRoleById($id)
    {
        $this->destroying_id = $id;
        $this->dispatchBrowserEvent('DestroyRoleModal');
    }
    public function onDestroyClick()
    {
        $deleting = Role::findOrFail($this->destroying_id);
        $deleting->delete();
        session()->flash('danger', 'El Rol fue eliminado!!');
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }

    public function showRoleById($id)
    {
        $show = Role::findOrFail($id);
        $this->viewing_id = $show->id;
        $this->name = $show->name;
        $this->dispatchBrowserEvent('showRoleModal');
    }
    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }
}
