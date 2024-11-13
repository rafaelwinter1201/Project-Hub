<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
        .danfe_pagina {
            font-size: 10px;
            font-family: Arial, Helvetica;
            margin: 0px;
            padding: 1px;
        }

        .danfe_pagina2 {
            margin: 1px;
            padding: 0;
        }

        .danfe_linha_tracejada {
            width: 100%;
            border-bottom: #000 1px dashed;
            margin: 10px 0 10px 0;
        }

        .danfe_tabelas {
            border-collapse: collapse;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .danfe_celula_bordas {
            border: 1px solid black;
            vertical-align: top;
        }

        .danfe_celula_titulo {
            margin: 0;
            font-size: 7pt;
            padding: 0 2px 0px 2px;
        }

        .danfe_celula_valor {
            margin: 0;
            font-size: 8pt;
            padding-left: 4px;
        }

        .danfe_canhoto_bordas {
            font-size: 7pt;
            border: 1px solid #000;
            margin: 0px;
            padding: 0;
            margin: 0 1px 0 1px;
            min-height: 30px;
        }

        .danfe_canhoto_texto {
            font-size: 6pt;
            margin: 0;
            font-weight: normal;
            padding: 0 2px 1px 2px;
        }

        .danfe_cabecalho_danfe {
            font-size: 13px;
            font-weight: bold;
            margin: 0;
            text-align: center;
        }

        .danfe_cabecalho_danfe_texto {
            font-size: 7pt;
            padding: 0;
            margin: 0 1px 0 1px;
            text-align: center;
        }

        .danfe_cabecalho_numero {
            font-size: 13px;
            font-weight: bold;
            margin: 0;
            text-align: center;
        }

        .danfe_cabecalho_entrada_saida {
            font-size: 7pt;
        }

        .danfe_cabecalho_entrada_saida_quadrado {
            font-size: 13pt;
            border: 1px solid #000000;
            padding: 0;
            margin: 0;
            width: 100px;
            text-align: center;
            float: none;
            min-width: 30px;
        }

        .no-wrap {
            white-space: nowrap !important;
            /* Impede que o conteúdo da célula seja quebrado */
        }

        .text-center {
            text-align: center;
        }

        .endereco {
            margin: 0;
            font-size: 6pt;
        }

        .danfe_titulo_externo {
            font-size: 8pt;
            margin: 4px 0 0 0;
            font-weight: bold;
        }

        .danfe_item {
            border: 1px black solid;
            border-top: none;
            border-bottom: dotted 1pt #dedede;
            font-size: 6pt;
            text-align: right;
        }

        .left-border {
            border-left: 2px solid #000;
        }

        .danfe_item_ultimo {
            border: 1px black solid;
            border-top: none;
            margin: 0px;
            padding: 0;
            font-size: 1px;
        }

        .ultimo {
            min-height: 100%;
        }

        .danfe_item_cabecalho {
            border: 1px solid #000;
            text-align: left;
            font-size: 7pt;
        }

        .danfe_item_cabecalho_tabela {
            border-collapse: collapse;
            width: 100%;
            margin: 0;
            padding: 0;
            border: 1px solid #000;
        }

        .obs {
            max-height: 100px !important;
            height: 50px !important;
        }
    </style>
    <title>Nf-e {{ $ObjXML->chNFe }}</title>
</head>

<body>

    <div class="danfe_pagina">
        <div class="danfe_pagina2">
            <!-- cabeçalho -->
            @include('pdf.partials.header-danfe', [
                'codigobarra' => $codigobarra,
                'ObjXML' => $ObjXML,
                'totalPaginas' => $totalPaginas,
                'paginaAtual' => $paginaAtual,
            ])
            {{-- CASO A PÁGINA SEJA A 1, ELE IMPRIME O CORPO --}}
            @if ($paginaAtual +1 === 1)
                @include('pdf.partials.body-danfe', [
                    'ObjXML' => $ObjXML,
                ])
            @endif
            <h3 class="danfe_titulo_externo">Itens da nota fiscal</h3>
            <table class="danfe_item_cabecalho_tabela">
                <tr>
                    <th class="danfe_item_cabecalho">C&oacute;digo</th>
                    <th class="danfe_item_cabecalho">
                        Descri&ccedil;&atilde;o do produto/servi&ccedil;o
                    </th>
                    <th class="danfe_item_cabecalho">NCM/SH</th>
                    <th class="danfe_item_cabecalho">CST</th>
                    <th class="danfe_item_cabecalho">CFOP</th>
                    <th class="danfe_item_cabecalho">UN</th>
                    <th class="danfe_item_cabecalho">Qtde</th>
                    <th class="danfe_item_cabecalho">Pre&ccedil;o un</th>
                    <th class="danfe_item_cabecalho">Pre&ccedil;o total</th>
                    <th class="danfe_item_cabecalho">BC ICMS</th>
                    <th class="danfe_item_cabecalho">Vlr. ICMS</th>
                    <th class="danfe_item_cabecalho">Vlr. IPI</th>
                    <th class="danfe_item_cabecalho">ICMS %</th>
                    <th class="danfe_item_cabecalho">IPI %</th>
                </tr>
                @foreach ($produtosPagina as $Produto)
                    <tr class="danfe_item">
                        <td align="left">{{ $Produto['prod']['cProd'] }}</td>
                        <td align="left">{{ $Produto['prod']['xProd'] }}</td>
                        <td>{{ $Produto['prod']['NCM'] }}</td>
                        <td class="no-wrap">
                            @if (isset($Produto['imposto']['PIS']['PISOutr']['CST']) && isset($Produto['imposto']['COFINS']['COFINSOutr']['CST']))
                                {{ $Produto['imposto']['PIS']['PISOutr']['CST'] . ' ' . $Produto['imposto']['COFINS']['COFINSOutr']['CST'] }}
                            @else
                                --
                            @endif
                        </td>
                        <td>{{ $Produto['prod']['CFOP'] }}</td>
                        <td>{{ $Produto['prod']['uCom'] }}</td>
                        <td>{{ $Produto['prod']['qCom'] }}</td>
                        <td>{{ $Produto['prod']['vUnCom'] }}</td>
                        <td>{{ $Produto['prod']['vProd'] }}</td>
                        <td>{{ $Produto['prod']['vProd'] }}</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td>0.00</td>
                    </tr>
                @endforeach

                <tr>
                    <td class="danfe_item_ultimo ultimo" colspan="14">&nbsp;</td>
                </tr>
            </table>

            <div class="danfe_titulo_externo">Dados adicionais</div>
            <table class="danfe_tabelas">
                <tr style="min-height: 200px !important">
                    <td class="danfe_celula_bordas obs" width="70%">
                        <p class="danfe_celula_titulo">Observa&ccedil;&otilde;es</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->obsevacao }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Reservado ao fisco</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
