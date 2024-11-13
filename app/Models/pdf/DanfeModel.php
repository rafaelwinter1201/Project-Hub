<?php

namespace App\Models\pdf;

use App\Models\pdf\XML;
use App\Models\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use DateTime;

class DanfeModel extends Model
{
    use HasFactory;

    /**
     * instancia nome da empresa
     * 
     * @var string
     */
    public $nomeEmpresa = '';

    /**
     * instancia numero da nfe, reutilizado no corpo
     * 
     * @var string
     */
    public $nNF = '';

    /**
     * instancia serie da nfe, reutilizado no corpo
     * 
     * @var string
     */
    public $serieNF = '';

    /**
     * instancia tipo de documento nfe (entrada ou saida)
     * 
     * @var string
     */
    public $tpNF = '';

    /**
     * instancia chave de acesso da nfe
     * 
     * @var string
     */
    public $chNFe = '';

    /**
     * instancia Natureza da operação da nfe
     * 
     * @var string
     */
    public $natOp = '';

    /**
     * instancia numero de protocolo
     * 
     * @var string
     */
    public $nProt = '';

    /**
     * instancia Inscrição Estadual da empresa remetente
     * 
     * @var string
     */
    public $IE = '';

    /**
     * instancia CNPJ da empresa remetente
     * 
     * @var string
     */
    public $CNPJ = '';

    public $enderecoEmpresa = '';
    public $numeroEmpresa = '';
    public $bairroEmpresa = '';
    public $cidadeEmpresa = '';
    public $ufEmpresa = '';
    public $cepEmpresa = '';
    public $estadoEmpresa = '';
    public $telefoneEmpresa = '';


    /**
     * instancia nome do destinatário
     * 
     * @var string
     */
    public $nomedestinatario = '';

    /**
     * instancia cpf ou cnpj do destinatário
     * 
     * @var string
     */
    public $cpfcnpjDestinatario = '';

    /**
     * instancia Inscrição Estadual do destinatário
     * 
     * @var string
     */
    public $ieDestinatario = '';

    /**
     * instancia Endereco do destinatário
     * 
     * @var string
     */
    public $endereçoDestinatario = '';

    /**
     * instancia complemento do destinatário
     * 
     * @var string
     */
    public $complementoDestinatario = '';

    /**
     * instancia numero do destinatário
     * 
     * @var string
     */
    public $numeroDestinatario = '';

    /**
     * instancia bairro do destinatário
     * 
     * @var string
     */
    public $bairroDestinatario = '';

    /**
     * instancia cep do destinatário
     * 
     * @var string
     */
    public $cepDestinatario = '';

    /**
     * instancia cidade do destinatário
     * 
     * @var string
     */
    public $cidadeDestinatario = '';

    /**
     * instancia telefone do destinatário
     * 
     * @var string
     */
    public $telefoneDestinatario = '';

    /**
     * instancia email do destinatário
     * 
     * @var string
     */
    public $ufDestinatario = '';

    /**
     * instancia Data da Emissao
     * 
     * @var string
     */
    public $dataEmissao = '';

    /**
     * instancia data da saida
     * 
     * @var string
     */
    public $dataSaida = '';

    /**
     * instancia hora da saida
     * 
     * @var string
     */
    public $horaSaida = '';

    /**
     * INSTANCIA FATURAMENTO
     *
     * @var string 
     */
    public $numeroFat = '';

    /**
     * INSTANCIA FATURAMENTO
     *
     * @var string 
     */
    public $valorFat = '';

    /**
     * INSTANCIA FATURAMENTO
     *
     * @var string 
     */
    public $descontoFat = '';

    /**
     * INSTANCIA FATURAMENTO
     *
     * @var string 
     */
    public $valorLiqFat = '';

    /**
     * INSTANCIA FATURAMENTO
     *
     * @var array 
     */
    public $duplicatas = [];

    /**
     * INSTANCIA IMPOSTOS
     *
     * @var string 
     */
    public $impBaseICMS = '';

    /**
     * INSTANCIA VALOR DO ICMS
     *
     * @var string
     */
    public $impValorICMS = '';

    /**
     * INSTANCIA BASE DO SUB ICMS
     *
     * @var string
     */
    public $impBaseSubICMS = '';

    /**
     * INSTANCIA VALOR DO SUB ICMS
     *
     * @var string
     */
    public $impValorSubICMS = '';

    /**
     * INSTANCIA VALOR TOTAL DA NOTA
     *
     * @var string
     */
    public $impValorTotal = '';

    /**
     * INSTANCIA FRETE
     *
     * @var string
     */
    public $impFrete = '';

    /**
     * INSTANCIA SEGURO
     *
     * @var string
     */
    public $impSeguro = '';

    /**
     * INSTANCIA DESCONTO
     *
     * @var string
     */
    public $impDesconto = '';

    /**
     * INSTANCIA OUTRAS DESPESAS
     *
     * @var string
     */
    public $impOutraDespesa = '';

    /**
     * INSTANCIA IPI
     *
     * @var string
     */
    public $impIPI = '';

    /**
     * INSTANCIA VALOR TOTAL DA NOTA
     *
     * @var string
     */
    public $impTotalNota = '';

    /**
     * INSTANCIA MODALIDADE DE FRETE
     *
     * @var string
     */
    public $modFrete = '';

    /**
     * INSTANCIA NOME DA TRANSPORTADORA
     *
     * @var string
     */
    public $transpNome = '';

    /**
     * INSTANCIA CNPJ DA TRANSPORTADORA
     *
     * @var string
     */
    public $transpCNPJ = '';

    /**
     * INSTANCIA ENDEREÇO DA TRANSPORTADORA
     *
     * @var string
     */
    public $transpEnd = '';

    /**
     * INSTANCIA CIDADE DA TRANSPORTADORA
     *
     * @var string
     */
    public $transpCidade = '';

    /**
     * INSTANCIA UF DA TRANSPORTADORA
     *
     * @var string
     */
    public $transpUF = '';

    /**
     * INSTANCIA VOLUME DO ITEM PARA FRETE
     *
     * @var string
     */
    public $freteVolume = '';

    /**
     * INSTANCIA PESO DO ITEM PARA FRETE
     *
     * @var string
     */
    public $fretePeso = '';

    /**
     * INSTANCIA ESPECIE DO ITEM PARA FRETE
     *
     * @var string
     */
    public $freteEspecie = '';

    /**
     * INSTANCIA PRODUTOS DA COMPRA
     *
     * @var array
     */
    public $produtos = [];

    /**
     * INSTANCIA OBSERVAÇÕES
     *
     * @var string
     */
    public $infAdic = '';


    /**
     * constructor da página
     */
    public function __construct($id)
    {
        self::init();

        $today = new DateTime();
        $client = new Client();

        $id = explode("-", $id);

        //verifica ambiente
        $apiurl = getenv('APIURL');
        if (getenv('APP_LOCAL')) {
            $apiurl = getenv('APIURL_testes');
        }

        $response = $client->request('GET', $apiurl . '/orders/xml/'. $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $_SESSION['user']['webToken'] // Utiliza o token da sessão
            ]
        ]);
        
        //instancia objeto xml
        $ObXml = json_decode($response->getBody()->getContents(), true);

        //transforma string do xml em array objeto
        $xml = simplexml_load_string($ObXml[0]['xml']);

        //<--TOPO -->
        //recebe nome da empresa "LTDA" 
        $this->nomeEmpresa = (string) Util::formataUcFisrt($xml->NFe->infNFe->emit->xNome);

        //recebe numero da nfe, reutilizado no corpo
        $this->nNF = (string) $xml->NFe->infNFe->ide->nNF;

        //recebe série da nfe, reutilizado no corpo
        $this->serieNF = (string) $xml->NFe->infNFe->ide->serie;
        //<-- FIM DO TOPO -->

        //<-- CORPO -->
        //recebe o tipo do documento nfe (entrada ou saida) 
        $this->tpNF = (string) $xml->NFe->infNFe->ide->tpNF;

        //recebe chave de acesso da nfe
        $this->chNFe = (string) $xml->protNFe->infProt->chNFe;

        //recebe a natureza da operação
        $this->natOp = (string) $xml->NFe->infNFe->ide->natOp;

        //recebe o numero de protocolo
        $this->nProt = (string) $xml->protNFe->infProt->nProt;

        //recebe Inscrição Estadual da empresa remetente
        $this->IE = (string) $xml->NFe->infNFe->emit->IE;

        //recebe CNPJ da empresa remetente
        $this->CNPJ = (string) Util::formatarCPFCNPJ($xml->NFe->infNFe->emit->CNPJ);
        //<-- FIM CORPO -->

        //<-- DADOS DO REMETENTE -->
        //retorna endereço do cliente
        $this->enderecoEmpresa = $xml->NFe->infNFe->emit->enderEmit->xLgr;

        // //retorna numero do cliente
        $this->numeroEmpresa = $xml->NFe->infNFe->emit->enderEmit->nro;

        //retorna cidade do cliente
        $this->cidadeEmpresa = $xml->NFe->infNFe->emit->enderEmit->xMun;

        //retorna cep do cliente
        $this->cepEmpresa = $xml->NFe->infNFe->emit->enderEmit->CEP;

        //retorna estado do cliente
        $this->estadoEmpresa = $xml->NFe->infNFe->emit->enderEmit->UF;

        //retorna uf do cliente
        $this->bairroEmpresa = $xml->NFe->infNFe->emit->enderEmit->xBairro;
        //<-- FIM DADOS DO REMETENTE -->

        //<-- DADOS DO DESTINATARIO -->
        //recebe nome do destinatário
        $this->nomedestinatario = (string) $xml->NFe->infNFe->dest->xNome;

        //recebe cpf ou cnpj do destinatário
        $this->cpfcnpjDestinatario = (string) Util::formatarCPFCNPJ($xml->NFe->infNFe->dest->CNPJ);

        //recebe Inscrição Estadual do destinatário
        $this->ieDestinatario = (string) $xml->NFe->infNFe->dest->IE;

        //recebe Endereço do destinatário
        $this->endereçoDestinatario = (string) $xml->NFe->infNFe->dest->enderDest->xLgr;

        //recebe numero da casa do destinatário
        $this->numeroDestinatario = (string) $xml->NFe->infNFe->dest->enderDest->nro;

        //recebe complemento do destinatario
        $this->complementoDestinatario = (string) $xml->NFe->infNFe->dest->enderDest->xCpl;

        //recebe bairro do destinatário
        $this->bairroDestinatario = (string) $xml->NFe->infNFe->dest->enderDest->xBairro;

        //recebe cep do destinatário
        $this->cepDestinatario = (string) $xml->NFe->infNFe->dest->enderDest->CEP;

        //recebe cidade do destinatário
        $this->cidadeDestinatario = (string) $xml->NFe->infNFe->dest->enderDest->xMun;

        //recebe telefone do destinatário
        $this->telefoneDestinatario = (string) $xml->NFe->infNFe->dest->enderDest->fone;

        //recebe uf do destinatário
        $this->ufDestinatario = (string) $xml->NFe->infNFe->dest->enderDest->UF;
        //<-- FIM DADOS DO DESTINATARIO -->

        //<-- DATAS -->
        //recebe Data da Emissao
        //$this->dataEmissao = $today->format('d/m/Y');
        $this->dataEmissao = Util::formatDate($xml->NFe->infNFe->ide->dhEmi, 'd/m/Y');

        //recebe Data da Saida
        $this->dataSaida = $today->format('d/m/Y');

        //recebe Hora da Saida
        $this->horaSaida = $today->format('H:i');
        //<-- FIM DATAS -->

        //<-- FATURAMENTOS -->
        //recebe numero da fatura
        $this->numeroFat = $xml->NFe->infNFe->cobr->fat->nFat;

        //recebe valor da fatura
        $this->valorFat = Util::formatMoney($xml->NFe->infNFe->cobr->fat->vOrig);

        //recebe desconto da fatura
        $this->descontoFat = Util::formatMoney($xml->NFe->infNFe->cobr->fat->vDesc);

        //recebe valor liquido da fatura
        $this->valorLiqFat = Util::formatMoney($xml->NFe->infNFe->cobr->fat->vLiq);

        //recebe duplicatas (parcelas)
        $this->duplicatas = $xml->NFe->infNFe->cobr;
        //<-- FIM FATURAMENTOS -->

        //<-- IMPOSTOS -->
        //valor base do icms
        $this->impBaseICMS = $xml->NFe->infNFe->total->ICMSTot->vBC;

        //valor do icms
        $this->impValorICMS = $xml->NFe->infNFe->total->ICMSTot->vICMS;

        //valor base do sub-icms
        $this->impBaseSubICMS = $xml->NFe->infNFe->total->ICMSTot->vBCST;

        //valor do sub-icms
        $this->impValorSubICMS = $xml->NFe->infNFe->total->ICMSTot->vST;

        //valor total do produtos
        $this->impValorTotal = $xml->NFe->infNFe->total->ICMSTot->vProd;

        //<-- IMP FRETE -->
        //valor do imposto do frete
        $this->impFrete = $xml->NFe->infNFe->total->ICMSTot->vFrete;

        //valor do imposto do seguro
        $this->impSeguro = $xml->NFe->infNFe->total->ICMSTot->vSeg;

        //valor do imposto do desconto
        $this->impDesconto = $xml->NFe->infNFe->total->ICMSTot->vDesc;

        //valor do imposto de outras despesas
        $this->impOutraDespesa = $xml->NFe->infNFe->total->ICMSTot->vOutro;

        //valor do imposto do ipi
        $this->impIPI = $xml->NFe->infNFe->total->ICMSTot->vIPI;

        //valor total do imposto da nota
        $this->impTotalNota = $xml->NFe->infNFe->total->ICMSTot->vNF;
        //<-- FIM IMP FRETE -->
        //<-- FIM IMPOSTOS -->

        //<-- DADOS DO FRETE -->
        //recebe modalidade de frete
        $this->modFrete = $xml->NFe->infNFe->transp->modFrete;

        //recebe nome da transportadora
        $this->transpNome = $xml->NFe->infNFe->transp->transporta->xNome;

        //recebe cnpj da transportadora
        $this->transpCNPJ = $xml->NFe->infNFe->transp->transporta->CNPJ;

        //recebe endereco da transportadora
        $this->transpEnd = $xml->NFe->infNFe->transp->transporta->xEnder;

        //recebe cidade da transportadora
        $this->transpCidade = $xml->NFe->infNFe->transp->transporta->xMun;

        //recebe uf da transportadora
        $this->transpUF = $xml->NFe->infNFe->transp->transporta->UF;

        //recebe volume do frete
        $this->freteVolume = $xml->NFe->infNFe->transp->vol->qVol;

        //recebe especie do frete
        $this->freteEspecie = $xml->NFe->infNFe->transp->vol->esp;

        //recebe peso do pacote
        $this->fretePeso = $xml->NFe->infNFe->transp->vol->pesoB;
        //<-- FIM DADOS DO FRETE -->
        //<-- TABELA PRODUTOS -->
        //recebe produtos do pedido
        $this->produtos = self::getProdutos($xml->NFe->infNFe);
        //<-- FIM TABELA PRODUTOS -->
        //<-- INFORMACOES ADICIONAIS -->
        //recebe informacoes adicionais
        $this->infAdic = $xml->NFe->infNFe->infAdic->infCpl;
        //<-- FIM INFORMACOES ADICIONAIS -->
    }
    public static function init()
    {
        //verifica se existe sessão ativa, senão, cria uma
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
         * MEOTODO RESPONSAVEL POR INSTANCIAR LISTA DE PRODUTOS
         *
         * @param array $produtos
         * @return array
         */
        public static function getProdutos($produtos)
        {
                // Converter para JSON
                $json = json_encode($produtos);

                // Converter JSON para array associativo
                $array = json_decode($json, true);

                // Retornar array com produtos
                return $array['det'];
        }
}
