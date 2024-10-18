@extends('layout.main')

@section('title', 'Orders')
@section('content')
    <ul class="nav nav-tabs px-3 pt-3">
        <li class="nav-item">
            <a class="nav-link active" href="" data-toggle="tab">
                Todos
                <span class="badge text-bg-warning" data-bs-toggle="tooltip"
                    data-bs-title="Total">{{ $response['x-total-items'] }}</span>
            </a>
        </li>
    </ul>
    <form method="post" id="filtro">
        @csrf
        <!-- BOTÕES OCULTOS PARA CONTROLE DE NEXT > E PREVIEW < -->
        <input type="hidden" id="buttonPressed" name="buttonPressed" value="">
        <div class="m-2">
            <div class="row gx-0">
                <div class="col">
                    <p class="d-inline-flex gap-1 pt-3">
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            <img src="{{ asset('images/filter.png') }}" alt="refresh" class="h-1_2" />
                            <spam class="text-pt-9">
                                Filtros
                            </spam>
                        </button>
                    </p>
                </div>
                <x-pagination :actualpage="$actualpage" :totalpage="$response['x-total-pages']" />
            </div>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    Filtros
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row">
                    <div style="width: auto;">
                        <small>
                            <b>Id do pedido:</b>
                        </small>
                        <input type="text" class="form-control" name="search"
                            value="{{ isset($filtros['search']) ? $filtros['search'] : '' }}"
                            placeholder="Buscar pelo id..." id="search" style="padding-left: -100px;" />
                    </div>
                    <div class="d-inline-block" style="width: auto;">
                        <small>
                            <b>Por página:</b>
                        </small>
                        <select name="limit" id="limit" class="form-select" aria-label="Default select example">
                            <option value="10" {{ $response['x-items-per-page'] == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ $response['x-items-per-page'] == 20 ? 'selected' : '' }}>20</option>
                            <option value="30" {{ $response['x-items-per-page'] == 30 ? 'selected' : '' }}>30</option>
                            <option value="40" {{ $response['x-items-per-page'] == 40 ? 'selected' : '' }}>40</option>
                            <option value="50" {{ $response['x-items-per-page'] == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <small>
                        <b>Status:</b>
                    </small>
                    <select class="form-select" id="status" name="status">
                        <option value="" selected disabled>Selecione as opções...</option>
                        <option value="Pendente">Pendente</option>
                        <option value="Processado">Processado</option>
                        <option value="Ag. Envio">Ag. Envio</option>
                        <option value="Enviado">Enviado</option>
                        <option value="Concluido">Concluido</option>
                        <option value="Cancelado">Cancelado</option>
                        <option value="Impedimento">Impedimento</option>
                    </select>
                    <div id="selectedOptions" style="display: inline;"></div>
                </div>
                <div class="row">
                    <small>
                        <b>Prazo:</b>
                    </small>
                    <select class="form-select" disabled id="tempoSLA" name="tempoSLA">
                        <option value="" selected disabled>Selecione as opções...</option>
                        <option value="vencido">Vencido</option>
                        <option value="perto">Próximo de vencer</option>
                        <option value="dentro">Á vencer</option>
                    </select>
                </div>
                <div class="row">
                    <small>
                        <b>Fornecedor:</b>
                    </small>
                    <input class="form-control" value="" name="fornecedor" list="datalistOptions" id="fornecedor"
                        placeholder="Buscar pelo fornecedor..." disabled />
                    <datalist id="datalistOptions">
                        <option value="PAKITA"></option>
                        <option value="VOPEN"></option>
                    </datalist>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- DATA INICIO E DATA FIM -->
                        <livewire:data-range />
                    </div>
                </div>
                <div class="pt-3">
                    <button type="submit" class="btn btn-outline-primary white-img blue-img" id="filtrar">
                        <img src="{{ asset('images/search.png') }}" alt="search" class="h-1_3" />
                        Filtrar
                    </button>
                    <button type="button" id="resetButton" onclick="limparCampos()"
                        class="btn btn-outline-danger white-img red-img">
                        <img src="{{ asset('images/clear.png') }}" alt="limpar" class="h-1_3" />
                        Limpar
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="m-2" style="min-height: 60vh">
        <table class="table table-striped p-5 pt-5">
            <thead class="text-nowrap">
                <tr class="table-tr">
                    <th scope="col">Fornecedor</th>
                    <th scope="col">SKUs</th>
                    <th scope="col">Id do pedido</th>
                    <th scope="col">Data de criação</th>
                    <th scope="col">Nome completo</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col">SLA</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="text-left align-middle" id="orders-table-body">
                @include('orders.orders')
            </tbody>
        </table>
    </div>
@endsection
