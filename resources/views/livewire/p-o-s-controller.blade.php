<div>
    <div class="container">
        <form wire:submit.prevent="saveSale">
            <div class="row justify-content-center">
                <div class="col-md-8 col-10">
                    <div class="card">
                        <div class="card-header align-items-center">
                            <h6 class="fw-bold">Listado de la compra</h6>
                        </div>
                        <div class="card-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success text-dark fw-bold">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger text-dark fw-bold">
                                    {{ session('error') }}
                                </div>
                            @endif
                            {{-- Nombre cliente --}}
                            <div class="row mb-3 form-group @error('cliente_nombre') has-errors @enderror">
                                <label for="cliente_nombre"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Nombre: ') }}</label>

                                <div class="col-md-6">
                                    <input id="cliente_nombre" type="text"
                                        class="form-control @error('cliente_nombre') is-invalid @enderror"
                                        value="{{ old('cliente_nombre') }}" required autofocus
                                        wire:model="cliente_nombre">

                                    @error('cliente_nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- fin nombre cliente --}}
                            {{-- cliente cedula --}}
                            <div class="row mb-3 form-group @error('cliente_cedula') has-errors @enderror">
                                <label for="cliente_cedula"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Cédula: ') }}</label>

                                <div class="col-md-6">
                                    <input id="cliente_cedula" type="text"
                                        class="form-control @error('cliente_cedula') is-invalid @enderror"
                                        value="{{ old('cliente_cedula') }}" required wire:model="cliente_cedula">

                                    @error('cliente_cedula')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- fin cliente cedula --}}
                            {{-- cliente telefono --}}
                            <div class="row mb-3 form-group @error('cliente_telefono') has-errors @enderror">
                                <label for="cliente_telefono"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Teléfono: ') }}</label>

                                <div class="col-md-6">
                                    <input id="cliente_telefono" type="text"
                                        class="form-control @error('cliente_telefono') is-invalid @enderror"
                                        value="{{ old('cliente_telefono') }}" required wire:model="cliente_telefono">

                                    @error('cliente_telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- fin cliente telefono --}}
                            {{-- form de productos --}}
                            <div class="">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="fw-bold">Productos</h6>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-sm btn-outline-secondary"
                                            wire:click.prevent="addProduct">Añadir producto</button>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saleProducts as $index => $saleProduct)
                                            <tr>
                                                <td class="form-group">
                                                    <select name="saleProducts[{{ $index }}][product_id]"
                                                        wire:model="saleProducts.{{ $index }}.product_id"
                                                        class="form-select">
                                                        <option value="">
                                                            <-- Elige un producto -->
                                                        </option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->nombre }}
                                                                (C$&ThinSpace;{{ number_format($product->precio_sin_iva, 2) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        name="saleProducts[{{ $index }}][quantity]"
                                                        class="form-control"
                                                        wire:model="saleProducts.{{ $index }}.quantity" />
                                                </td>
                                                <td>
                                                    <a href="#" class="card-link"
                                                        wire:click.prevent="removeProduct({{ $index }})">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- form de productos --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-2">
                    <div class="row">
                        {{-- @livewire('pos.total', ['saleProducts' => $saleProducts]) --}}
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-header fw-bold">Formulario de pago</div>
                                <div class="card-body">
                                    <div class="row">
                                        <p class="h6"><b>Subtotal:
                                            </b>C${{ number_format($total_venta, 2) }}
                                        </p>
                                        <p class="h4"><b>IVA:
                                            </b>C${{ number_format($iva, 2) }}
                                        </p>
                                        <p class="h2"><b>TOTAL:
                                            </b>C${{ number_format($total, 2) }}
                                        </p>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text col justify-content-center" id="basic-addon1">
                                                <label class="form-check-label">
                                                    C$
                                                </label>
                                                <input class="form-check-input mt-0 ms-2" type="checkbox"
                                                    wire:model="pagando_con_cordobas" aria-label="pagando con cordobas">
                                            </span>
                                            <input id="paga_con_cordobas" type="text"
                                                class="form-control @error('paga_con_cordobas') is-invalid @enderror"
                                                name="paga_con_cordobas" {{ $pagando_con_cordobas ? '' : 'disabled' }}
                                                wire:model="paga_con_cordobas"
                                                value="{{ number_format($paga_con_cordobas, 2) }}">
                                            <button class="btn btn-outline-secondary fw-bold"
                                                {{ $pagando_con_cordobas ? '' : 'disabled' }}
                                                wire:click.prevent="totalPagadoCordobas" data-bs-toggle="tooltip"
                                                data-bs-title="Está pagando con córdobas" data-bs-placement="top"
                                                data-bs-animation="true">+</button>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text col justify-content-center" id="basic-addon1">
                                                <label class="form-check-label">
                                                    $
                                                </label>
                                                <input class="form-check-input mt-0 ms-2" type="checkbox"
                                                    wire:model="pagando_con_dolares" aria-label="pagando con dolares">
                                            </span>
                                            <input id="paga_con_dolares" type="text"
                                                class="form-control @error('paga_con_dolares') is-invalid @enderror"
                                                name="paga_con_dolares" {{ $pagando_con_dolares ? '' : 'disabled' }}
                                                wire:model="paga_con_dolares"
                                                value="{{ number_format($paga_con_dolares, 2) }}">
                                            <button class="btn btn-outline-secondary fw-bold"
                                                {{ $pagando_con_dolares ? '' : 'disabled' }}
                                                wire:click.prevent="totalPagadoDolares" data-bs-toggle="tooltip"
                                                data-bs-title="Está pagando con dólares" data-bs-placement="top"
                                                data-bs-animation="true">+</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="{{ $vuelto >= 0 ? 'text-success' : 'text-danger' }}">
                                            C$
                                            {{ number_format($vuelto, 2) }}</p>
                                    </div>
                                    <div class="row">
                                        <button type="submit" class="btn btn-sm btn-secondary py-2"
                                            wire:loading.attr="disable">
                                            {{ __('Añadir') }}
                                            <div class="spinner-bsale" role="status" wire:loading
                                                wire:target="savesale">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                    {{-- botoncito de submit --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
