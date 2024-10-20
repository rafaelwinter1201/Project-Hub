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
    </style>
    <title>Nf-e {{ $ObjXML->chNFe }}</title>
</head>

<body>

    <div class="danfe_pagina">
        <div class="danfe_pagina2">
            <!-- cabeçalho -->
            @include('pdf.partials.header-danfe', ['codigobarra' => $codigobarra, 'ObjXML' => $ObjXML])

            <h3 class="danfe_titulo_externo">Destinat&aacute;rio/Remetente</h3>
            <table class="danfe_tabelas">
                <tr>
                    <td>
                        <table class="danfe_tabelas">
                            <tr>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">
                                        Nome / Raz&atilde;o Social
                                    </p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->nomedestinatario }}</p>
                                </td>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">CNPJ/CPF</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->cpfcnpjDestinatario }}</p>
                                </td>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">
                                        Inscri&ccedil;&atilde;o Estadual
                                    </p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->ieDestinatario }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">Endere&ccedil;o</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->endereçoDestinatario }}</p>
                                </td>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">Bairro</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->bairroDestinatario }}</p>
                                </td>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">CEP</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->cepDestinatario }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">Munic&iacute;pio</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->cidadeDestinatario }}</p>
                                </td>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">Fone/Fax</p>
                                    <p class="danfe_celula_valor"></p>
                                </td>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">UF</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->ufDestinatario }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="10%">
                        <table class="danfe_tabelas">
                            <tr>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">Data emiss&atilde;o</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->dataEmissao }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">Data sa&iacute;da</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->dataSaida }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="danfe_celula_bordas">
                                    <p class="danfe_celula_titulo">Hora sa&iacute;da</p>
                                    <p class="danfe_celula_valor">{{ $ObjXML->horaSaida }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <h3 class="danfe_titulo_externo">Faturas</h3>
            <table class="danfe_tabelas">
                <tr class="danfe_item_cabecalho_tabela" align="left">
                    <th class="danfe_item_cabecalho">N&uacute;mero</th>
                    <th class="danfe_item_cabecalho">Valor</th>
                    <th class="danfe_item_cabecalho">Desconto</th>
                    <th class="danfe_item_cabecalho" style="text-align: right">
                        Valor Liq.
                    </th>
                </tr>
                <tr class="danfe_item">
                    <td align="left">{{ $ObjXML->numeroFat }}</td>
                    <td align="left">R$ {{ $ObjXML->valorFat }}</td>
                    <td align="left">R$ {{ $ObjXML->descontoFat }}</td>
                    <td style="border-right: solid black 1px">R$ {{ $ObjXML->valorLiqFat }}</td>
                </tr>
                <tr>
                    <td class="danfe_item_ultimo" colspan="4">&nbsp;</td>
                </tr>
            </table>
            <h3 class="danfe_titulo_externo">Duplicatas</h3>
            <table class="danfe_tabelas">
                <tr class="danfe_item_cabecalho_tabela" align="left">
                    <th class="danfe_item_cabecalho">N&uacute;mero</th>
                    <th class="danfe_item_cabecalho">Vencimento</th>
                    <th class="danfe_item_cabecalho">Valor</th>
                </tr>
                @php
                    // Converter para JSON
                    $json = json_encode($ObjXML->duplicatas);

                    // Converter JSON para array associativo
                    $dados = json_decode($json, true);

                    // tirar campo desnecessario
                    unset($dados['fat']);
                @endphp
                @foreach ($dados as $item)
                    <tr class="danfe_item">
                        <td align="left">{{ $item['nDup'] }}</td>
                        <td align="left">{{ $item['dVenc'] }}</td>
                        <td align="left">R$ {{ $item['vDup'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="danfe_item_ultimo" colspan="9">&nbsp;</td>
                </tr>
            </table>
            <h3 class="danfe_titulo_externo">C&aacute;lculo do imposto</h3>
            <table class="danfe_tabelas">
                <tr>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Base de c&aacute;lculo do ICMS</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impBaseICMS }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Valor do ICMS</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impValorICMS }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">
                            Base de c&aacute;lculo do ICMS Subst.
                        </p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impBaseSubICMS }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Valor do ICMS Subst.</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impValorSubICMS }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Valor total dos produtos</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impValorTotal }}</p>
                    </td>
                </tr>
            </table>
            <table class="danfe_tabelas">
                <tr>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Valor do frete</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impFrete }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Valor do seguro</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impSeguro }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Desconto</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impDesconto }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">
                            Outras despesas acess&oacute;rias
                        </p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impOutraDespesa }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Valor do IPI</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impIPI }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Valor total da nota</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->impTotalNota }}</p>
                    </td>
                </tr>
            </table>
            <h3 class="danfe_titulo_externo">
                Transportador/Volumes transportados
            </h3>
            <table class="danfe_tabelas">
                <tr>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Nome</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->transpNome }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Frete por conta</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->modFrete }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">C&oacute;digo ANTT</p>
                        <p class="danfe_celula_valor">&nbsp;</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Placa do ve&iacute;culo</p>
                        <p class="danfe_celula_valor">&nbsp;</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">UF</p>
                        <p class="danfe_celula_valor">&nbsp;</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">CNPJ/CPF</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->freteCNPJ }}</p>
                    </td>
                </tr>
            </table>
            <table class="danfe_tabelas">
                <tr>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Endere&ccedil;o</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->transpEnd }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Munic&iacute;pio</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->transpCidade }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">UF</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->transpUF }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">
                            Inscri&ccedil;&atilde;o Estadual
                        </p>
                        <p class="danfe_celula_valor">ISENTO</p>
                    </td>
                </tr>
            </table>
            <table class="danfe_tabelas">
                <tr>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Quantidade</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->freteVolume }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Esp&eacute;cie</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->freteEspecie }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Marca</p>
                        <p class="danfe_celula_valor">&nbsp;</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Numera&ccedil;&atilde;o</p>
                        <p class="danfe_celula_valor">&nbsp;</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Peso bruto</p>
                        <p class="danfe_celula_valor">{{ $ObjXML->fretePeso }}</p>
                    </td>
                    <td class="danfe_celula_bordas">
                        <p class="danfe_celula_titulo">Peso l&iacute;quido</p>
                        <p class="danfe_celula_valor">&nbsp;</p>
                    </td>
                </tr>
            </table>
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
                @foreach ($ObjXML->produtos as $Produto)
                    <tr class="danfe_item">
                        <td align="left">{{ $Produto['prod']['cProd'] }}</td>
                        <td align="left">{{ $Produto['prod']['xProd'] }}</td>
                        <td>{{ $Produto['prod']['NCM'] }}</td>
                        <td class="no-wrap">
                            @if (isset($Produto['imposto']['PIS']['PISOutr']['CST']) && isset($Produto['imposto']['COFINS']['COFINSOutr']['CST']) )
                                {{ $Produto['imposto']['PIS']['PISOutr']['CST'] . ' ' .  $Produto['imposto']['COFINS']['COFINSOutr']['CST'] }}
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
                    <td class="danfe_item_ultimo" colspan="14">&nbsp;</td>
                </tr>
            </table>

            <div class="danfe_titulo_externo">Dados adicionais</div>
            <table class="danfe_tabelas">
                <tr style="min-height: 200px !important">
                    <td class="danfe_celula_bordas" width="70%" style="min-height: 200px !important">
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