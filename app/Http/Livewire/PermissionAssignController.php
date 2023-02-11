<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAssignController extends Component
{
    public $permisos, $roles;
    public Collection $selectedPermissions;
    public $selectedRole;
    public $role, $permissions;

    public function mount()
    {
        $this->permisos = Permission::all()->pluck(value: 'name', key: 'id');
        $this->roles = Role::all()->pluck(value: 'name', key: 'id');
        $this->selectedRole = '1';
        $this->role = Role::findById(id: $this->selectedRole)->load(relations: 'permissions');
        $this->selectedPermissions = collect($this->role->getAllPermissions()->pluck('id', 'id'));
    }
    public function updatedSelectedRole($value)
    {
        if ($value != 0) {
            $this->role = Role::findById(id: $value);
            $this->role->load(relations: 'permissions');
            $this->selectedPermissions = collect($this->role->getAllPermissions()->pluck('id', 'id'));
            $this->dispatchBrowserEvent('alertaPermisos', $this->getSelectedPermissions());
        } else {
            $this->selectedPermissions = collect();
            $this->selectedRole = 0;
            $this->role = "";
        }
    }
    public function render()
    {
        return view('livewire.permission-assign-controller', [
            'permisos' => $this->permisos,
            'roles' => $this->roles
        ])->extends('layouts.app')->section('content');
    }
    public function getSelectedPermissions()
    {
        return $this->selectedPermissions->filter(fn ($p) => $p)->keys();
    }
    public function syncPermissions()
    {
        $this->role->syncPermissions($this->getSelectedPermissions());
        // $this->refresh();
    }
    public function syncAllPermissions()
    {
        $this->role->syncPermissions(Permission::all()->pluck('id'));
        // $this->refresh();

    }
    public function revokeAllPermissions()
    {
        $this->role->syncPermissions();
        // $this->refresh();

    }

    // abort_if(!in_array(), Response:HTTP_NOT_FOUND);
}
