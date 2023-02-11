<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Asignar permisos a un rol') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row">
                                    <label for="selectedRole"
                                        class="col-md-auto col-form-label text-md-end">{{ __('Roles: ') }}</label>
                                    <div class="col-md-6">
                                        <select name="selectedRole" id="selectedRole" wire:model="selectedRole"
                                            class="form-select">
                                            @foreach ($roles as $id => $role)
                                                <option value="{{ $id }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <table class="table table-sm table-bordered">
                                <thead class="table-secondary">
                                    <tr class="text-center">
                                        <th style="font:bold;">Permiso</th>
                                    </tr>
                                </thead>
                                {{-- {{ dd($permisos) }} --}}
                                <tbody>
                                    @forelse ($permisos as $id => $permiso)
                                        <tr class="text-center">
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" name="selectedPermissions"
                                                        id="selectedPermissions"
                                                        wire:model="selectedPermissions.{{ $id }}"
                                                        {{ $this->role->permissions->contains($id) ? 'checked' : '' }}
                                                        class="form-check-input">
                                                    <label for="selectedPermissions"
                                                        class="form-check-label">{{ $permiso }}</label>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr class="text-center">
                                            <td colspan="2" style="font-style:italic;">No se encontraron datos en los
                                                registros...</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <button class="btn btn-sm btn-secondary" type="button"
                                wire:click="syncPermissions()">Sincronizar
                                permisos</button>
                            <button class="btn btn-sm btn-secondary mt-4" type="button"
                                wire:click="syncAllPermissions()">Sincronizar
                                todo</button>
                            <button class="btn btn-sm btn-secondary mt-4" type="button"
                                wire:click="revokeAllPermissions()">Quitar
                                todo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <pre>{{ json_encode($selectedRole) }}</pre>
    </div>
    <pre>{{ json_encode($selectedPermissions) }}</pre>
    <pre>{{ json_encode($role) }}</pre>
    @push('scripts')
        <script>
            window.addEventListener('alertaPermisos', function(data) {
                console.log(data.detail);
            })
        </script>
    @endpush
</div>
