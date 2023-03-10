<div class="col-12 mb-3">
    <div class="card">
        <div class="card-header">Total + IVA</div>
        <div class="card-body">
            C$ {{ number_format($total_venta/100, 2) }}
            <pre>{{ json_encode($orderProducts) }}</pre>
        </div>
    </div>
</div>
