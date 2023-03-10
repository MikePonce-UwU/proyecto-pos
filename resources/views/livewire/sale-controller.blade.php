<div wire:poll.visible>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fw-bold">Registro de ventas</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>Nombre del cliente</th>
                                    <th>Nombre vendedor</th>
                                    <th>Total pagado</th>
                                    <th>Fecha venta</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr class="text-center">
                                        <td>{{ $sale->cliente_nombre }}</td>
                                        <td>{{ $sale->user->name }}</td>
                                        <td>C$  {{ number_format($sale->total_venta, 2) }}</td>
                                        <td>{{ $sale->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="#" wire:click.prevent="showSaleById({{ $sale->id }})" class="card-link">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="viewSale" tabindex="-1" aria-labelledby="ViewSale"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ver detalle de compra</h1>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->singleSale->products as $sale)
                                <tr>
                                    <td>{{ $sale->nombre }} (C$    {{ number_format($sale->precio_sin_iva, 2) }})</td>
                                    <td>{{ $sale->pivot->cantidad }}</td>
                                    <td>{{ number_format(($sale->precio_sin_iva)*$sale->pivot->cantidad, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
</div>
@push('scripts')
<script>
    window.addEventListener('closeModal', event => {
        $('#viewSale').modal('hide');
    });
    window.addEventListener('showSaleModal', event => {
        $("#viewSale").modal('show');
    })
</script>
@endpush
