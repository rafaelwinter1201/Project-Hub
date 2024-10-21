@php
    use Carbon\Carbon;
    use App\Models\Util;
@endphp
@foreach ($response['body'] as $order)
    <tr>
        <td class="text-center text-nowrap">{{ $order['detalhes']['fornecedor'] }}</td>
        <td class="text-nowrap">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    {{-- caso tenha mais de um, precisa criar um dropdown com cada sku da compra --}}
                    @if (count($order['produtos']) > 1)
                        <a class="nav-link dropdown-togle" role="button" data-bs-toggle="dropdown" id="dropdownMenuLink"
                            aria-expanded="false">
                            <img src="{{ asset('images/plussku.png') }}" style="width: 1.1rem" alt="Lista de SKU" />
                            SKU: {{ $order['produtos'][0]['referencia'] }}...
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <li>
                                @foreach ($order['produtos'] as $orders)
                                    <a class="dropdown-item copy-text" data-text="{{ $orders['referencia'] }}"
                                        data-bs-toggle="tooltip" data-bs-title="Copiar!">
                                        {{ $orders['referencia'] }}
                                    </a>
                                @endforeach
                            </li>
                        </ul>
                    @else
                        {{-- se não tiver mais de 1, ele cria o próprio link, sem o dropdown --}}
                        <a class="nav-link copy-text" data-text="{{ $order['produtos'][0]['referencia'] }}"
                            data-bs-toggle="tooltip" data-bs-title="Copiar!" style="cursor: pointer;">
                            <img src="{{ asset('images/plussku.png') }}" style="width: 1.1rem" alt="Lista de SKU" />
                            SKU: {{ $order['produtos'][0]['referencia'] }}
                        </a>
                    @endif
                </li>
            </ul>
        </td>
        <td class="text-nowrap">
            <a href="{{ route('details', ['idpedido' => $order['detalhes']['numero_de_pedido']]) }}"
                class="text-decoration-none text-reset" data-bs-toggle="tooltip" data-bs-title="Ir para detalhes">
                {{ $order['detalhes']['numero_de_pedido'] }}
            </a>
            <a class="copy-text hover-pointer" data-text="{{ $order['detalhes']['numero_de_pedido'] }}" data-bs-toggle="tooltip" data-bs-title="Copiar!">
                <img src="{{ asset('images/redirect.png') }}" alt="redirecionar para detalhes" height="15rem" />
            </a>
        </td>
        <td class="text-nowrap">
            {{ Carbon::parse($order['detalhes']['data_de_criacao'])->format('d/m/Y H:i') }}
        </td>
        <td>
            {{ ucwords(strtolower($order['cliente']['nome'] . ' ' . $order['cliente']['sobrenome'])) }}
        </td>
        <td class="text-nowrap">
            @foreach ($order['produtos'] as $produto)
                @php
                    $soma = $produto['preco_unitario'] * $produto['quantidade'] - $produto['desconto_unitario'];
                    $frete = $order['detalhes']['valor_frete'] - $order['detalhes']['desconto_frete'];
                @endphp
                R$ {{ number_format($soma + $frete, 2, ',', '.') }}
            @endforeach
        </td>
        <td class="text-nowrap">
            <p class="stats">
                {{ Util::getNameStatus($order['detalhes']['status']) }}
            </p>
        </td>
        <td class="text-nowrap">
            <!-- img -->
            @php
                $colorPago = '';
                $colorTruck = '';
                $colorDelivery = '';

                switch ($order['detalhes']['status']) {
                    default:
                        $colorPago = 'color-line';
                        $colorTruck = 'color-line';
                        $colorDelivery = 'color-line';
                        break;
                    case 'processed':
                    case 'processing':
                    case 'invoiced':
                    case 'fulfilled':
                        $colorPago = 'green';
                        $colorTruck = 'color-line';
                        $colorDelivery = 'color-line';
                        break;
                    case 'sent':
                    case 'shipped':
                        $colorPago = 'green';
                        $colorTruck = 'green';
                        $colorDelivery = 'color-line';
                        break;
                    case 'finished':
                    case 'delivered':
                        $colorPago = 'green';
                        $colorTruck = 'green';
                        $colorDelivery = 'green';
                        break;
                }
            @endphp
            <!-- img -->
            <img src="{{ asset('images/money.png') }}" data-bs-toggle="tooltip" data-bs-title="Pagamento"
                class="h-1_5 {{ $colorPago }}" alt="Pagamento" />
            <img src="{{ asset('images/truck.png') }}" data-bs-toggle="tooltip" data-bs-title="Envio"
                class="h-1_5 {{ $colorTruck }}" alt="A caminho" />
            <img src="{{ asset('images/delivery.png') }}" data-bs-toggle="tooltip" data-bs-title="Entrega"
                class="h-1_5 {{ $colorDelivery }}" alt="Saiu para entrega" />
        </td>
        <td class="text-nowrap">
            {{ Util::getsla($order['detalhes']['data_de_criacao']) }}
        </td>
        <td class="text-nowrap">
            <a href="{{ route('details', ['idpedido' => $order['detalhes']['numero_de_pedido']]) }}"
                style="text-decoration: none" data-bs-toggle="tooltip" data-bs-title="Detalhes">
                <img src="{{ asset('images/details.png') }}" class="h-1_5" alt="Mais informações" />
            </a>
            @if (!empty($order['faturamento']['nfe']))
                <a href="{{ route('danfe', ['idpedido' => $order['detalhes']['numero_de_pedido']]) }}" target="_blank"
                    class="link-offset-2 link-underline link-underline-opacity-0 color-line" data-bs-toggle="tooltip"
                    data-bs-title="Imprimir Danfe">
                    <img src="{{ asset('images/barcode.png') }}" class="h-1_5" alt="Danfe" />
                </a>
                @if (!empty($order['faturamento']['tracking_code']))
                    <a href="{{ route('label', ['idpedido' => $order['detalhes']['numero_de_pedido']]) }}"
                        target="_blank" class="link-offset-2 link-underline link-underline-opacity-0 color-line"
                        data-bs-toggle="tooltip" data-bs-title="Imprimir Etiqueta">
                        <img src="{{ asset('images/etiqueta.png') }}" class="h-1_5" alt="Etiqueta de envio" />
                    </a>
                @endif
            @endif
        </td>
    </tr>
    <!-- Toast para exibir mensagem de sucesso -->
    <div id="copyToast" class="toast text-bg-success align-items-center position-fixed bottom-0 end-0 m-3"
        role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 6">
        <div class="d-flex">
            <div class="toast-body">O texto foi copiado!</div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endforeach
<script>
    document.getElementById('page').value = '{{ $response['info'] }}'; // Altera o valor do input
    if ({{ $response['info'] }} <= 1) {
        $('#botaoAnterior').addClass('disabled');
    } else {
        $('#botaoAnterior').removeClass('disabled');
    }

    if ({{ $response['info'] }} >= {{ $response['x-total-pages'] }}) {
        $('#botaoProximo').addClass('disabled');
    } else {
        $('#botaoProximo').removeClass('disabled');
    }

    // Se houver apenas uma página, desabilita ambos
    if ({{ $response['x-total-pages'] }} === 1) {
        $('#botaoAnterior').addClass('disabled');
        $('#botaoProximo').addClass('disabled');
    }
    document.getElementById('total-page').textContent = '{{ $response['x-total-pages'] }}';
    document.getElementById('Total').textContent = '{{ $response['x-total-items'] }}';

    document.getElementById('page').max = '{{ $response['x-total-pages'] }}';
</script>
