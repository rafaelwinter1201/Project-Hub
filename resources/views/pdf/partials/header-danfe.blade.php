<table class="danfe_tabelas">
    <tr>
      <td>
        <table class="danfe_tabelas" style="min-height: 60px">
          <tr>
            <td class="danfe_celula_bordas" colspan="2">
              <p class="danfe_canhoto_texto">
                RECEBEMOS DE {{ $ObjXML->nomeEmpresa }} OS PRODUTOS CONSTANTES DA NOTA FISCAL
                INDICADA AO LADO
              </p>
            </td>
          </tr>
          <tr>
            <td class="danfe_canhoto_bordas">
              <p class="danfe_celula_titulo">Data de recebimento</p>
              <p class="danfe_celula_valor">&nbsp;</p>
            </td>
            <td class="danfe_canhoto_bordas">
              <p class="danfe_celula_titulo">
                Identifica&ccedil;&atilde;o e assinatura do recebedor
              </p>
              <p class="danfe_celula_valor">&nbsp;</p>
            </td>
          </tr>
        </table>
      </td>
      <td>&nbsp;</td>
      <td>
        <table class="danfe_tabelas" style="min-height: 60px">
          <tr>
            <td class="danfe_celula_bordas" align="center">
              <strong>NF-e</strong>
              <h2 class="danfe_cabecalho_numero">N&ordm; {{$ObjXML->nNF}}</h2>
              <strong>S&eacute;rie {{$ObjXML->serieNF}}</strong>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <div class="danfe_linha_tracejada"></div>
  <table class="danfe_tabelas">
    <tr>
      <td rowspan="3" class="danfe_celula_bordas text-center">
        <p style="margin: 0; font-size:12pt">{{$ObjXML->nomeEmpresa}}</p>
        <p class="endereco" style="font-size:8pt">{{$ObjXML->enderecoEmpresa}}, {{$ObjXML->numeroEmpresa}}</p>
        <p class="endereco" style="font-size:8pt">{{$ObjXML->bairroEmpresa}}, {{$ObjXML->cepEmpresa}}</p>
        <p class="endereco" style="font-size:8pt">{{$ObjXML->cidadeEmpresa}}, {{$ObjXML->estadoEmpresa}}</p>
      </td>
  
      <td rowspan="3" class="danfe_celula_bordas" align="center">
        <p class="danfe_cabecalho_danfe">DANFE</p>
        <p class="danfe_cabecalho_danfe_texto">
          Documento Auxiliar da <br />Nota Fiscal Eletr&ocirc;nica
        </p>
        <table class="danfe_tabelas">
          <tr>
            <td nowrap class="danfe_cabecalho_entrada_saida">
              0-Entrada<br />
              1-Sa&iacute;da
            </td>
            <td class="danfe_cabecalho_entrada_saida_quadrado">{{$ObjXML->tpNF}}</td>
          </tr>
        </table>
        <p class="danfe_cabecalho_numero">N&ordm; {{$ObjXML->nNF}}</p>
        <p class="danfe_cabecalho_danfe_texto">               {{--  gambiarra aq cof --}}
          SERIE: {{$ObjXML->serieNF}}<br />P&aacute;gina: {{ $paginaAtual +1 }} de {{ $totalPaginas }}
        </p>
      </td>
      <td
        class="danfe_celula_bordas"
        style="padding: 0.4rem auto 0.4rem"
        align="center"
      >
      <img src="data:image/png;base64,{{ base64_encode((string) $codigobarra) }}" style="padding-bottom=1rem;padding-top=1rem !important;">
    </td>
    </tr>
    <tr>
      <td class="danfe_celula_bordas" align="center">
        <p class="danfe_celula_titulo">Chave de acesso</p>
        <p class="danfe_celula_valor">{{$ObjXML->chNFe}}</p>
      </td>
    </tr>
    <tr>
      <td class="danfe_celula_bordas" align="center">
        <p class="danfe_celula_titulo">
          Consulta de autenticidade no portal nacional da NF-e
        </p>
        <p class="danfe_celula_valor">
          <a href="http://www.nfe.fazenda.gov.br/portal" target="_blank"
            >www.nfe.fazenda.gov.br/portal</a
          >
          ou no site da Sefaz autorizadora
        </p>
      </td>
    </tr>
    <tr>
      <td colspan="2" class="danfe_celula_bordas">
        <p class="danfe_celula_titulo">Natureza da opera&ccedil;&atilde;o</p>
        <p class="danfe_celula_valor">{{$ObjXML->natOp}}</p>
      </td>
      <td class="danfe_celula_bordas" align="center">
        <p class="danfe_celula_titulo">
          N&uacute;mero de protocolo de autoriza&ccedil;&atilde;o de uso da NF-e
        </p>
        <p class="danfe_celula_valor">{{$ObjXML->nProt}}</p>
      </td>
    </tr>
  </table>
  <table class="danfe_tabelas">
    <tr>
      <td class="danfe_celula_bordas">
        <p class="danfe_celula_titulo">Inscri&ccedil;&atilde;o Estadual</p>
        <p class="danfe_celula_valor">{{$ObjXML->IE}}</p>
      </td>
      <td class="danfe_celula_bordas">
        <p class="danfe_celula_titulo">Inscr.est. do subst.trib.</p>
        <p class="danfe_celula_valor">&nbsp;</p>
      </td>
      <td class="danfe_celula_bordas">
        <p class="danfe_celula_titulo">CNPJ</p>
        <p class="danfe_celula_valor">{{$ObjXML->CNPJ}}</p>
      </td>
    </tr>
  </table>
  