<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-content-center">
                            <div class="col">
                                {{ __('Listado de Productos') }}
                            </div>
                            <div class="col-auto">
                                @can('product-store')
                                    <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#addNewProduct">
                                        Añadir Producto
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
                                        <th style="font:bold;">Producto</th>
                                        <th style="font:bold;">Cantidad</th>
                                        <th style="font:bold;">Precio</th>
                                        <th style="font:bold;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($productos as $producto)
                                        <tr class="text-center">
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->cantidad }}</td>
                                            <td>C$  {{ number_format($producto->precio_sin_iva, 2) }}</td>
                                            <td>
                                                <div class="btn-toolbar justify-content-center" role="toolbar">
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-secondary" type="button"
                                                            wire:click="showProductById({{ $producto->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-eye"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path
                                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                        </button>
                                                        @can('product-update')
                                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                                wire:click="editProductById({{ $producto->id }})">
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
                                                        @can('product-destroy')
                                                            <button class="btn btn-sm btn-outline-secondary" type="button"
                                                                wire:click="deleteProductById({{ $producto->id }})">
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
                                            <td colspan="4" style="font-style:italic;">No se encontraron datos en los
                                                registros...</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $productos->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal para añadir nuevo registro --}}
    <div wire:ignore.self class="modal fade" id="addNewProduct" data-bs-backdrop="static" tabindex="-1" aria-labelledby="AddNewProduct"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Ítem</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> pa luego xd --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="onFormSubmit">
                        <div class="row mb-3">
                            <label for="nombre"
                                class="col-md-4 col-form-label text-md-end">{{ __('Nombre:') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text"
                                    class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    value="{{ old('nombre') }}" required autofocus wire:model="nombre">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="descripcion"
                                class="col-md-4 col-form-label text-md-end">{{ __('Descripción:') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="descripcion" type="number"
                                    class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                                    value="{{ old('descripcion') }}" required wire:model="descripcion"> --}}
                                <textarea class="form-control" id="descripcion" cols="30" rows="10" wire:model="descripcion">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cantidad"
                                class="col-md-4 col-form-label text-md-end">{{ __('Cantidad:') }}</label>

                            <div class="col-md-6">
                                <input id="cantidad" type="number"
                                    class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                    value="{{ old('cantidad') }}" required wire:model="cantidad">
                                {{-- <textarea class="form-control" id="cantidad" cols="30" rows="10" wire:model="cantidad">{{ old('cantidad') }}</textarea> --}}
                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="precio_anterior"
                                class="col-md-4 col-form-label text-md-end">{{ __('Precio neto: ') }}</label>

                            <div class="col-md-6">
                                <input id="precio_anterior" type="number"
                                    class="form-control @error('precio_anterior') is-invalid @enderror" name="precio_anterior"
                                    value="{{ old('precio_anterior') }}" required wire:model="precio_anterior">
                                {{-- <textarea class="form-control" id="precio_anterior" cols="30" rows="10" wire:model="precio_anterior">{{ old('precio_anterior') }}</textarea> --}}
                                @error('precio_anterior')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="precio_sin_iva"
                                class="col-md-4 col-form-label text-md-end">{{ __('Precio sin IVA: ') }}</label>

                            <div class="col-md-6">
                                <input id="precio_sin_iva" type="number"
                                    class="form-control @error('precio_sin_iva') is-invalid @enderror" name="precio_sin_iva"
                                    value="{{ old('precio_sin_iva') }}" wire:model="precio_sin_iva" disabled>
                                {{-- <textarea class="form-control" id="precio_sin_iva" cols="30" rows="10" wire:model="precio_sin_iva">{{ old('precio_sin_iva') }}</textarea> --}}
                                @error('precio_sin_iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="category_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Categoría: ') }}</label>
                            <div class="col-md-6">
                                <select name="category_id" id="category_id" wire:model="category_id"
                                    class="form-select">
                                    <option value="0">-- Elegir una opción --</option>
                                    @foreach ($categorias as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
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
    <div wire:ignore.self class="modal fade" id="editProduct" data-bs-backdrop="static" tabindex="-1" aria-labelledby="EditProduct"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> pa luego xd --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="onUpdateSubmit">
                        <div class="row mb-3">
                            <label for="nombre"
                                class="col-md-4 col-form-label text-md-end">{{ __('Nombre:') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text"
                                    class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    value="{{ old('nombre') }}" required autofocus wire:model="nombre">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="descripcion"
                                class="col-md-4 col-form-label text-md-end">{{ __('Descripción:') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="descripcion" type="number"
                                    class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                                    value="{{ old('descripcion') }}" required wire:model="descripcion"> --}}
                                <textarea class="form-control" id="descripcion" cols="30" rows="10" wire:model="descripcion">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cantidad"
                                class="col-md-4 col-form-label text-md-end">{{ __('Cantidad:') }}</label>

                            <div class="col-md-6">
                                <input id="cantidad" type="number"
                                    class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                    value="{{ old('cantidad') }}" required wire:model="cantidad">
                                {{-- <textarea class="form-control" id="cantidad" cols="30" rows="10" wire:model="cantidad">{{ old('cantidad') }}</textarea> --}}
                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="precio_anterior"
                                class="col-md-4 col-form-label text-md-end">{{ __('Precio Neto:') }}</label>

                            <div class="col-md-6">
                                <input id="precio_anterior" type="number"
                                    class="form-control @error('precio_anterior') is-invalid @enderror" name="precio_anterior"
                                    value="{{ old('precio_anterior') }}" required wire:model="precio_anterior">
                                {{-- <textarea class="form-control" id="precio_anterior" cols="30" rows="10" wire:model="precio_anterior">{{ old('precio_anterior') }}</textarea> --}}
                                @error('precio_anterior')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="precio_sin_iva"
                                class="col-md-4 col-form-label text-md-end">{{ __('precio sin IVA') }}</label>

                            <div class="col-md-6">
                                <input id="precio_sin_iva" type="number"
                                    class="form-control @error('precio_sin_iva') is-invalid @enderror" name="precio_sin_iva"
                                    value="{{ old('precio_sin_iva') }}" required wire:model="precio_sin_iva" disabled>
                                {{-- <textarea class="form-control" id="precio_sin_iva" cols="30" rows="10" wire:model="precio_sin_iva">{{ old('precio_sin_iva') }}</textarea> --}}
                                @error('precio_sin_iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="category_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Categoría: ') }}</label>
                            <div class="col-md-6">
                                <select name="category_id" id="category_id" wire:model="category_id"
                                    class="form-select">
                                    <option value="0">-- Elegir una opción --</option>
                                    @foreach ($categorias as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
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
    <div wire:ignore.self class="modal fade" id="viewProduct" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ViewProduct"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ver Ítem</h1>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="nombre"
                            class="col-md-4 col-form-label text-md-end">{{ __('Nombre: ') }}</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text"
                                class="form-control" name="nombre" disabled wire:model="nombre">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="descripcion"
                            class="col-md-4 col-form-label text-md-end">{{ __('Descripción: ') }}</label>

                        <div class="col-md-6">
                            <textarea class="form-control" id="descripcion" cols="30" rows="10" wire:model="descripcion" disabled></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="cantidad"
                            class="col-md-4 col-form-label text-md-end">{{ __('Cantidad: ') }}</label>

                        <div class="col-md-6">
                            <input id="cantidad" type="number"
                                class="form-control" name="cantidad" disabled wire:model="cantidad">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="precio_anterior"
                            class="col-md-4 col-form-label text-md-end">{{ __('Precio Neto: ') }}</label>

                        <div class="col-md-6">
                            <input id="precio_anterior" type="number"
                                class="form-control" name="precio_anterior" disabled wire:model="precio_anterior">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="precio_sin_iva"
                            class="col-md-4 col-form-label text-md-end">{{ __('Precio sin IVA:') }}</label>

                        <div class="col-md-6">
                            <input id="precio_sin_iva" type="number"
                                class="form-control" name="precio_sin_iva" disabled wire:model="precio_sin_iva">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="category_id"
                            class="col-md-4 col-form-label text-md-end">{{ __('Categoría: ') }}</label>
                        <div class="col-md-6">
                            <select name="category_id" id="category_id" wire:model="category_id"
                                class="form-select" disabled>
                                <option value="0">-- Elegir una opción --</option>
                                @foreach ($categorias as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
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
    <div wire:ignore.self class="modal fade" id="destroyProduct" data-bs-backdrop="static" tabindex="-1" aria-labelledby="DestroyProduct"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Ítem</h1>
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
            $('#viewProduct').modal('hide');
            $('#addNewProduct').modal('hide');
            $('#editProduct').modal('hide');
            $('#destroyProduct').modal('hide');
        });
        window.addEventListener('openEditModal', event => {
            $("#editProduct").modal('show');
        })
        window.addEventListener('DestroyProductModal', event => {
            $("#destroyProduct").modal('show');
        })
        window.addEventListener('showProductModal', event => {
            $("#viewProduct").modal('show');
        })
    </script>
@endpush
