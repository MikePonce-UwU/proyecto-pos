<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-content-center">
                            <div class="col">
                                {{ __('Listado de Usuarios') }}
                            </div>
                            <div class="col-auto">
                                @can('user-store')
                                    <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#addNewUser">
                                        Añadir Usuario
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('info'))
                            <div class="alert alert-info text-center" role="alert">
                                {{ session('info') }}
                            </div>
                        @endif
                        @if (session('danger'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{ session('danger') }}
                            </div>
                        @endif

                        {{-- tabla --}}
                        <div class="row justify-content-center">
                            <table class="table table-sm table-bordered">
                                <thead class="table-secondary">
                                    <tr class="text-center">
                                        <th style="font:bold;">Usuario</th>
                                        <th style="font:bold;">E-mail</th>
                                        <th style="font:bold;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($usuarios as $usuario)
                                        @if (auth()->id() == $usuario->id)
                                            @continue
                                        @endif
                                        <tr class="text-center">
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                <div class="btn-toolbar justify-content-center" role="toolbar">
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-secondary" type="button"
                                                            wire:click="showUserById({{ $usuario->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-eye"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path
                                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                        </button>
                                                        @can('user-update')
                                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                                wire:click="editUserById({{ $usuario->id }})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-clipboard" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                                    <path
                                                                        d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        @can('user-destroy')
                                                            <button class="btn btn-sm btn-outline-secondary" type="button"
                                                                wire:click="deleteUserById({{ $usuario->id }})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                    <path fill-rule="evenodd"
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                    </div>
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
                            {{ $usuarios->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal para añadir nuevo registro --}}
    <div wire:ignore.self class="modal fade" id="addNewUser" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="AddNewUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Usuario</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> pa luego xd --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="onFormSubmit">
                        <div class="row mb-3">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus wire:model="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required wire:model="email">
                                {{-- <textarea class="form-control" id="email" cols="30" rows="10" wire:model="email">{{ old('email') }}</textarea> --}}
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="role_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Roles: ') }}</label>
                            <div class="col-md-6">
                                <select name="role_id" id="role_id" wire:model="role" class="form-select">
                                    <option value="0">-- Elegir una opción --</option>
                                    @foreach ($roles as $name => $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ old('password') }}" required wire:model="password">
                                {{-- <textarea class="form-control" id="password" cols="30" rows="10" wire:model="password">{{ old('password') }}</textarea> --}}
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}" required
                                    wire:model="password_confirmation">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-secondary">
                                    {{ __('Añadir') }}
                                </button>
                                <button type="button" data-bs-dismiss="modal" wire:click="closeModal()"
                                    class="btn btn-sm btn-secondary">
                                    {{ __('Cancelar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
        </div>
    </div>
    {{-- modal para editar un registro --}}
    <div wire:ignore.self class="modal fade" id="editUser" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="EditUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> pa luego xd --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="onUpdateSubmit">
                        <div class="row mb-3">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required wire:model="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required wire:model="email">
                                {{-- <textarea class="form-control" id="email" cols="30" rows="10" wire:model="email">{{ old('email') }}</textarea> --}}
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Roles: ') }}</label>
                            <div class="col-md-6">
                                <select name="role_id" id="role_id" wire:model="role" class="form-select">
                                    <option value="0">-- Elegir una opción --</option>
                                    @foreach ($roles as $name => $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ old('password') }}" wire:model="password">
                                {{-- <textarea class="form-control" id="password" cols="30" rows="10" wire:model="password">{{ old('password') }}</textarea> --}}
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}"
                                    wire:model="password_confirmation">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-secondary">
                                    {{ __('Editar') }}
                                </button>
                                <button type="button" data-bs-dismiss="modal" wire:click="closeModal()"
                                    class="btn btn-sm btn-secondary">
                                    {{ __('Cancelar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
        </div>
    </div>
    {{-- modal para ver un registro --}}
    <div wire:ignore.self class="modal fade" id="viewUser" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="ViewUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ver Usuario</h1>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" disabled
                                value="{{ $this->name }}">

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $this->email }}" disabled>
                            {{-- <textarea class="form-control" id="email" cols="30" rows="10" wire:model="email">{{ old('email') }}</textarea> --}}
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="role_id" class="col-md-4 col-form-label text-md-end">{{ __('Roles: ') }}</label>
                        <div class="col-md-6">
                            <select name="role_id" id="role_id" wire:model="role" class="form-select" disabled>
                                <option value="0">-- Elegir una opción --</option>
                                @foreach ($roles as $name => $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" wire:click="closeModal()"
                        class="btn btn-sm btn-secondary">
                        {{ __('Cancelar') }}
                    </button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- modal para borrar(softdeletes) un registro --}}
    <div wire:ignore.self class="modal fade" id="destroyUser" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="DestroyUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> pa luego xd --}}
                </div>
                <div class="modal-body">
                    <h5 class="text-center"><strong>Estás seguro de querer eliminar este registro? No se puede revertir
                            este cambio.</strong></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" wire:click="closeModal()"
                        class="btn btn-sm btn-secondary">
                        {{ __('Cancelar') }}
                    </button>
                    <button type="button" class="btn btn-primary" wire:click="onDestroyClick()">Sí,
                        Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            // document.getElementById('addNewUser').hide();
            // document.getElementById('editUser').hide();
            $('#viewUser').modal('hide');
            $('#addNewUser').modal('hide');
            $('#editUser').modal('hide');
            $('#destroyUser').modal('hide');
        });
        window.addEventListener('openEditModal', event => {
            $("#editUser").modal('show');
        })
        window.addEventListener('DestroyUserModal', event => {
            $("#destroyUser").modal('show');
        })
        window.addEventListener('showUserModal', event => {
            $("#viewUser").modal('show');
        })
    </script>
@endpush
