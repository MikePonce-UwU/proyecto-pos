<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Component
{
    use WithPagination;

    public $updating_id, $destroying_id, $viewing_id;
    public $name, $email, $password, $password_confirmation, $role;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.user-controller', [
            'usuarios' => User::paginate(5),
            'roles' => Role::all()->pluck(value: 'name', key: 'name')
        ])->extends('layouts.app')->section('content');
    }
    // public function updated($field)
    // {
    //     return $this->validateOnly($field, [
    //         'name' => 'required|max:125|min:3',
    //         'email' => 'required|max:125|min:3|email|unique:users',
    //     ]);
    // }
    public function onFormSubmit()
    {
        $this->validate([
            'name' => 'required|max:125|min:3',
            'email' => 'required|max:125|min:3|email|unique:users',
            'password' => 'required|max:12|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $new = new User([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        if ($this->role != 0) {
            $new->syncRoles($this->role);
        }
        $new->save();
        session()->flash('success', 'Nuevo Usuario fue añadido!!');
        $this->closeModal();
    }


    public function editUserById($id)
    {
        $user = User::findOrFail($id);
        $this->updating_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first();
        $this->dispatchBrowserEvent('openEditModal');
    }
    public function onUpdateSubmit()
    {
        $this->validate([
            'name' => 'max:125|min:3',
            'email' => 'max:125|min:3|email',
            'password_confirmation' => 'same:password',
        ]);
        $updating = User::findOrFail($this->updating_id);
        $updating->name = $this->name;
        $updating->email = $this->email;
        if (!empty($this->password)) {
            $updating->password = bcrypt($this->password);
        }
        if ($this->role != 0) {
            $updating->syncRoles($this->role);
        }
        $updating->save();
        session()->flash('info', 'El Usuario fue modificado!!');
        $this->closeModal();
    }


    public function deleteUserById($id)
    {
        $this->destroying_id = $id;
        $this->dispatchBrowserEvent('DestroyUserModal');
    }
    public function onDestroyClick()
    {
        $deleting = User::findOrFail($this->destroying_id);
        $deleting->syncRoles();
        $deleting->delete();
        session()->flash('danger', 'El Usuario fue eliminado!!');
        $this->closeModal();
    }

    public function showUserById($id)
    {
        $show = User::findOrFail($id);
        $this->viewing_id = $show->id;
        $this->name = $show->name;
        $this->email = $show->email;
        $this->role = $show->getRoleNames()->first();
        $this->dispatchBrowserEvent('showUserModal');
    }
    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('closeModal');
    }
}
