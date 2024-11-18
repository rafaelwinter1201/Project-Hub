<a href="javascript:void(0)" class="link-offset-2 link-underline link-underline-opacity-0 color-line"
    data-bs-toggle="tooltip" data-bs-title="Imprimir Danfe" onclick="openModal()">
    <img src="{{ asset('images/barcode.png') }}" class="h-1_5" alt="Danfe" />
</a>
@if (!empty($order['faturamento']['tracking_code']))
    <a href="{{ route('label', ['idpedido' => $order['faturamento']['nfe']]) }}" target="_blank"
        class="link-offset-2 link-underline link-underline-opacity-0 color-line" data-bs-toggle="tooltip"
        data-bs-title="Imprimir Etiqueta">
        <img src="{{ asset('images/etiqueta.png') }}" class="h-1_5" alt="Etiqueta de envio" />
    </a>
@endif

{{-- MODAL --}}
<div class="modal fade" id="danfeModal" tabindex="-1" aria-labelledby="danfeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="danfeModalLabel">Configurar impressão da NF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="danfeForm">
                    <div class="mb-3">
                        <label for="campo1" class="form-label">Produtos por página (página 1):</label>
                        <input type="number" class="form-control" id="campo1" value="22">
                    </div>
                    <div class="mb-3">
                        <label for="campo2" class="form-label">Produtos por página (páginas 2,3...):</label>
                        <input type="number" class="form-control" id="campo2" value="45">
                    </div>
                </form>
                <div class="alert alert-danger  alert-dismissible fade show pt-8" role="alert">
                    <strong>Configure como desejar!</strong> cuidado com a quebra de página.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="redirectDanfe()">Imprimir NF</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        var danfeModal = new bootstrap.Modal(document.getElementById('danfeModal'));
        danfeModal.show();
    }

    function redirectDanfe() {
        // Obtenha os valores dos campos
        const campo1 = document.getElementById('campo1').value;
        const campo2 = document.getElementById('campo2').value;

        // Substitua os valores na rota
        const qtprod = `${campo1}-${campo2}`;
        const idpedido = '{{ $order['id'] }}';

        // Construa a URL e redirecione
        const url = `{{ route('danfe', ['qtprod' => ':qtprod', 'idpedido' => ':idpedido']) }}`
            .replace(':qtprod', qtprod)
            .replace(':idpedido', idpedido);

        window.open(url, '_blank');
    }
</script>
