<a href="{{ route('danfe', ['idpedido' => $order['detalhes']['numero_de_pedido']]) }}" target="_blank"
    class="link-offset-2 link-underline link-underline-opacity-0 color-line" data-bs-toggle="tooltip"
    data-bs-title="Imprimir Danfe">
    <img src="{{ asset('images/barcode.png') }}" class="h-1_5" alt="Danfe" />
</a>
@if (!empty($order['faturamento']['tracking_code']))
    <a href="{{ route('label', ['idpedido' => $order['detalhes']['numero_de_pedido']]) }}" target="_blank"
        class="link-offset-2 link-underline link-underline-opacity-0 color-line" data-bs-toggle="tooltip"
        data-bs-title="Imprimir Etiqueta">
        <img src="{{ asset('images/etiqueta.png') }}" class="h-1_5" alt="Etiqueta de envio" />
    </a>
@endif
