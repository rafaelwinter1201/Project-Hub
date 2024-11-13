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
@if (isset($ObjXML->numeroFat))
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
@endif
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

        $dados['dup'] = is_array($ObjXML->duplicatas) ? $ObjXML->duplicatas : [$ObjXML->duplicatas];
    @endphp
    @if (is_array($dados['dup']))
        @foreach ($dados['dup'] as $item)
            <tr class="danfe_item">
                <td align="left">{{ $item['nDup'] }}</td>
                <td align="left">{{ $item['dVenc'] }}</td>
                <td align="left">R$ {{ $item['vDup'] }}</td>
            </tr>
        @endforeach
    @endif
    <tr>
        <td class="danfe_item_ultimo" colspan="3">&nbsp;</td>
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
