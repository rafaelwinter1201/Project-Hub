@php
    use Carbon\Carbon;
    use App\Models\Util;
@endphp

@extends('layout.main')

@section('title', 'Detalhes')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 pt-3 order-1">
                <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
                    <nav class="nav nav-pills flex-column">
                        <a class="nav-link" href="#item-1">Informações Gerais</a>
                        <a class="nav-link" href="#item-2">Itens do Pedido</a>
                        @if (!empty($order['faturamento']['tracking_code']))
                            <a class="nav-link" href="#item-3">Faturamento</a>
                        @endif
                        <a class="nav-link" href="#item-4">Dados de entrega</a>
                    </nav>
                </nav>
            </div>
            <div class="col-10 pt-3 order-2 fullvh">
                <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true"
                    class="scrollspy-example-2 fullvh" tabindex="0">
                    <div id="item-1">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>
                                    Informações Gerais - {{ $order['detalhes']['numero_de_pedido'] }}
                                </span>
                                @if (!empty($order['faturamento']['nfe']))
                                    <span class="mx-2">
                                        @include('components.acoes-danfe-etiqueta')
                                    </span>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <p><strong>Número do Pedido:</strong> {{ $order['detalhes']['numero_de_pedido'] }}
                                        </p>
                                        <p><strong>Data do Pedido:</strong>
                                            {{ Carbon::parse($order['detalhes']['data_de_criacao'])->format('d/m/Y H:i') }}
                                        </p>
                                        <p class="inline-block">
                                            <strong class="inline-block">Status:</strong>
                                            <span class="stats inline-block">
                                                {{ Util::getNameStatus($order['detalhes']['status']) }}</span>
                                            <a id="status-link" class="nav-link inline-block text-danger" href="#item-4"
                                                data-bs-toggle="tooltip" data-bs-title="Detalhes do status">
                                                #
                                            </a>
                                        </p>
                                        <p><strong>Método de pagamento:</strong>
                                            {{ $order['faturamento']['ordem_de_compra']['metodo'] }}</p>
                                        <p>
                                            <strong>Fornecedor:</strong> {{ $order['detalhes']['fornecedor'] }}
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="inline-block"><strong>SLA: </strong>
                                            {{ Util::getsla($order['detalhes']['data_de_criacao']) }}</p>
                                        <p>
                                            <strong>Plataforma:</strong> {{ $order['detalhes']['plataforma'] }} <br />
                                        </p>
                                        <p><strong>Código ERP:</strong> {{ $order['detalhes']['codigo_erp'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="item-2">
                        <div class="card mt-3">
                            <div class="card-header">Itens do Pedido</div>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Qtd</th>
                                                <th scope="col no-wrap">Preço Unit</th>
                                                <th scope="col">Desconto</th>
                                                <th scope="col">Preço Total</th>
                                                <th scope="col">Cor</th>
                                                <th scope="col">Tamanho</th>
                                                <th scope="col">EAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order['produtos'] as $produto)
                                                {{-- {{tabela}} --}}
                                                <td scope="col no-wrap">{{ $produto['referencia'] }}</td>
                                                <td scope="col">{{ $produto['nome_de_produto'] }}</td>
                                                <td scope="col no-wrap">{{ count($order['produtos']) }}</td>
                                                <td scope="col no-wrap">R$
                                                    {{ number_format($produto['preco_unitario'], 2, ',', '.') }}</td>
                                                <td scope="col no-wrap">R$
                                                    {{ number_format($produto['desconto_unitario'], 2, ',', '.') }}</td>
                                                @php
                                                    $somaproduto = $produto['preco_unitario'] * $produto['quantidade'];
                                                @endphp
                                                <td scope="col no-wrap">R$ {{ number_format($somaproduto, 2, ',', '.') }}
                                                </td>
                                                <td scope="col no-wrap">{{ ucFirst($produto['cor']) }}</td>
                                                <td scope="col no-wrap">{{ ucFirst($produto['tamanho']) }}</td>
                                                <td scope="col no-wrap">{{ $produto['ean'] }}</td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row mt-4 text-center">
                                        <div class="col">
                                            <p>
                                                <strong>Quantia:</strong>
                                                <br />
                                                {{ count($order['produtos']) }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="no-wrap"><strong>Valor Total:</strong>
                                                @php
                                                    $valor_desconto = 0;
                                                    $valor_frete = 0;
                                                    foreach ($order['produtos'] as $produto) {
                                                        // preco x quantidade - desconto (valor total)
                                                        $soma =
                                                            $produto['preco_unitario'] * $produto['quantidade'] -
                                                            $produto['desconto_unitario'];
                                                        //frete unitario
                                                        $frete_unitario =
                                                            $order['detalhes']['valor_frete'] -
                                                            $order['detalhes']['desconto_frete'];

                                                        //total dos descontos unitarios
                                                        $valor_desconto += $produto['desconto_unitario'];
                                                        //total dos descontos
                                                        $valor_frete += $frete_unitario;
                                                    }
                                                @endphp
                                                <br />
                                                R$ {{ number_format($soma, 2, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p>
                                                <strong>Frete:</strong>
                                                <br />
                                                R$ {{ number_format($valor_frete, 2, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p>
                                                <strong>Desconto:</strong>
                                                <br />
                                                R$ {{ number_format($valor_desconto, 2, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="no-wrap">
                                                <b>Valor final:</b>
                                                <br />
                                                R$ {{ number_format($valor_frete + $soma, 2, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="item-3">
                        @if (!empty($order['faturamento']['tracking_code']))
                            <div class="card mt-3">
                                <div class="card-header">Faturamento</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Chave NF-e:</strong> {{ $order['faturamento']['nfe'] }}</p>
                                            <p><strong>URL Rastreio:</strong> {{ $order['faturamento']['tracking_url'] }}
                                            </p>
                                            <p><strong>Código de Rastreio:</strong>
                                                {{ $order['faturamento']['tracking_code'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="item-4">
                        <div class="card mt-3">
                            <div class="card-header">Dados de Entrega</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nome:</strong> {{ $order['cliente']['nome'] }}
                                            {{ $order['cliente']['sobrenome'] }}</p>
                                        <p><strong>Endereço:</strong>
                                            {{ $order['cliente']['endereco_de_entrega']['rua'] }}</p>
                                        <p><strong>Complemento:</strong>
                                            {{ $order['cliente']['endereco_de_entrega']['complemento'] }}</p>
                                        <p><strong>Cidade:</strong>
                                            {{ $order['cliente']['endereco_de_entrega']['cidade'] }}</p>
                                        <p><strong>Bairro:</strong>
                                            {{ $order['cliente']['endereco_de_entrega']['bairro'] }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>CPF/CNPJ:</strong> {{ $order['cliente']['cpf_cnpj'] }}</p>
                                        <p><strong>Método de entrega:</strong>
                                            {{ $order['detalhes']['metodo_de_entrega'] }}</p>
                                        <p><strong>CEP:</strong> {{ $order['cliente']['endereco_de_entrega']['cep'] }}</p>
                                        <p><strong>País:</strong> {{ $order['cliente']['endereco_de_entrega']['pais'] }}
                                        </p>
                                    </div>
                                    <div class="row">{{ Util::getTimeline($order['detalhes']['status']) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
