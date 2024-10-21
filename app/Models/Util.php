<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Util extends Model
{
    use HasFactory;

    public static function getNameStatus($status)
    {
        // possíveis status
        //in english
        // pending > processed/processing > /invoiced/fulfilled > sent/shipped > finished/delivered
        // canceled
        // fraud | on_hold | shippment_exception

        //in portuguese
        // Pendente > Ag. Envio > Enviado > Concluido
        // Cancelado 
        // Impedimento
        switch ($status) {
            case 'pending':
            case 'processing':
                return 'Pendente';
                break;
            case 'processed':
                return 'Processado';
                break;
            case 'invoiced':
            case 'fulfilled':
                return 'Ag. Envio';
                break;
            case 'sent':
            case 'shipped':
                return 'Enviado';
                break;
            case 'finished':
            case 'delivered':
                return 'Concluido';
                break;
            case 'canceled':
                return 'Cancelado';
                break;
            case 'fraud':
            case 'on_hold':
            case 'shipment_exception':
                return 'Impedimento';
                break;
            default:
                $nameStatus = self::getStatusName($status);
                return $nameStatus;
                break;
        }
    }
    public static function getStatusName($status)
    {
        //in portuguese
        // Pendente >Processado > Ag. Envio > Enviado > Concluido
        // Cancelado | Impedimento
        switch ($status) {
            case 'Pendente':
                return [
                    'pending',
                    'processing'
                ];
                break;
            case 'Processado':
                return [
                    'processed'
                ];
                break;
            case 'Ag. Envio':
                return [
                    'invoiced',
                    'fulfilled'
                ];
                break;
            case 'Enviado':
                return [
                    'sent',
                    'shipped'
                ];
                break;
            case 'Concluido':
                return [
                    'finished',
                    'delivered'
                ];
                break;
            case 'Cancelado':
                return [
                    'canceled'
                ];
                break;
            case 'Impedimento':
                return [
                    'on_hold',
                    'fraud',
                    'shippment_exception'
                ];
                break;
            default:
                return 'N/A';
                break;
        }
    }
    public static function getSla($sla)
    {
        // Define o timezone para o Brasil
        date_default_timezone_set('America/Sao_Paulo');

        // Converter a string de data para um objeto DateTime
        $dataInicial = new DateTime($sla);
        $dataAtual = new DateTime();

        // Adicionar 12 dias úteis à data recebida
        $dataExpiracao = self::adicionarDiasUteis(clone $dataInicial, 5);

        // Verificar se a data de expiração está no futuro ou no passado
        $cor = '';
        $dias = 0;
        $horas = 0;

        if ($dataExpiracao > $dataAtual) {
            // Calcular os dias e horas restantes
            $intervaloRestante = $dataAtual->diff($dataExpiracao);
            $dias = $intervaloRestante->days;
            $horas = $intervaloRestante->h;

            if ($dias <= 3) {
                $cor = 'laranja';
            } else {
                $cor = 'green';
            }
        } else {
            // Calcular os dias e horas passados
            $intervaloPassado = $dataExpiracao->diff($dataAtual);
            $dias = $intervaloPassado->days;
            $horas = $intervaloPassado->h;
            $cor = 'red';
        }

        return view('partials.temposla', [
            'dias' => $dias,
            'horas' => $horas,
            'cor' => $cor
        ]);
    }

    private static function adicionarDiasUteis($data, $diasUteis)
    {
        $data_pascoa = new DateTime();
        $data_pascoa->setTimestamp(easter_date($data->format('Y')));

        $feriados = [
            // Lista de feriados no formato 'm-d'
            '01-01', // Ano Novo
            '04-21', // Tiradentes
            '05-01', // Dia do Trabalhador
            '09-07', // Independência do Brasil
            '10-12', // Nossa Senhora Aparecida
            '11-02', // Finados
            '11-15', // Proclamação da República
            '12-25', // Natal
            $data_pascoa->format('m-d') // Páscoa
        ];

        while ($diasUteis > 0) {
            // Verificar se é final de semana ou feriado
            if ($data->format('N') < 6 && !in_array($data->format('m-d'), $feriados)) {
                $diasUteis--;
            }
            $data->modify('+1 day');
        }

        return $data;
    }

    public static function getTimeline($statusAtual)
    {
        // Pendente > Processado > Facturado > Realizado > Enviado > Concluido

        // Cancelado | Fraude | Em Espera

        $statusAtual = self::getNameStatus($statusAtual);

        $statusProgressoName = 'Cancelado';
        if ($statusAtual == 'Fraude' || $statusAtual == 'Em Espera') {
            $statusProgressoName = $statusAtual;
        }

        $statusAtual = ($statusAtual == 'Realizado' || $statusAtual == 'Facturado') ? 'Ag. Envio' : $statusAtual;

        // Array de mapeamento de status para percentuais de progresso
        $statusProgresso = [
            $statusProgressoName => 0,
            'Pendente' => 17,
            'Processando' => 35,
            'Processado' => 50,
            'Ag. Envio' => 67,
            'Enviado' => 82,
            'Concluido' => 100
        ];

        // Obter o percentual de progresso com base no status atual
        $percentualProgresso = $statusProgresso[$statusAtual];

        $statuses = [
            $statusProgressoName,
            'Pendente',
            'Processando',
            'Processado',
            'Ag. Envio',
            'Enviado',
            'Concluido'
        ];

        return view('details.timeLine', [
            'statusAtual' => $statusAtual,

            'statuses' => $statuses,
            'statusProgresso' => $statusProgresso,

            //opções selecionadas
            'percentualProgresso' => $percentualProgresso
        ]);
    }

    /**
     * MÉTODO RESPONSÁVEL POR RETORNAR DATA FORMATADA
     *
     * @param string $date
     * @return timestamp
     */
    public static function formatDate($date, $format = 'd/m/Y - H:i')
    {
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }

    /**
     * MÉTODO RESPONSAVEL POR FORMATAR UM NUMERO EM VALOR
     *
     * @param float $money
     * @return float
     */
    public static function formatMoney($money)
    {
        $json = json_encode($money);
        $money = (array) json_decode($json);
        $money = isset($money[0]) ? $money[0] : $money;
        
        return number_format($money, 2, ',', '.');
    }

    /**
     * MÉTODO RESPONSÁVEL POR RETORNAR STRING COM PRIMEIRA LETRA MAIUSCULA
     *
     * @param string $status
     * @return timestamp
     */
    public static function formataUcFisrt($text)
    {
        return ucfirst(strtolower($text));
    }

    /**
     * MÉTODO RESPONSAVEL POR FORMATAR CPF OU CNPJ
     *
     * @param integer $documento
     * @return string
     */
    public static function formatarCPFCNPJ($documento)
    {
        // Remove caracteres não numéricos
        $documento = preg_replace("/[^0-9]/", "", $documento);

        // Verifica se é CPF (11 dígitos) ou CNPJ (14 dígitos)
        if (strlen($documento) === 11) {
            // Formata CPF: 000.000.000-00
            return substr($documento, 0, 3) . '.' . substr($documento, 3, 3) . '.' . substr($documento, 6, 3) . '-' . substr($documento, 9, 2);
        } elseif (strlen($documento) === 14) {
            // Formata CNPJ: 00.000.000/0000-00
            return substr($documento, 0, 2) . '.' . substr($documento, 2, 3) . '.' . substr($documento, 5, 3) . '/' . substr($documento, 8, 4) . '-' . substr($documento, 12, 2);
        } else {
            // Retorna o documento sem formatação, caso não seja CPF nem CNPJ
            return $documento;
        }
    }

    /**
     * METODO RESPONSAVEL POR RENDERIZAR O CODIGO DE BARRAS
     *
     * @param int $chave
     * @return string
     */
    public static function getBarCode($chave)
    {
        //transforma chave em string
        $str_chave = (string) $chave;

        //instancia classe para gerar o codigo de barras
        $generator = new BarcodeGeneratorPNG();

        //gera o codigo de barras
        $barcode = $generator->getBarcode($str_chave, $generator::TYPE_CODE_128, 1, 30);

        //retorna o codigo de barras
        return $barcode;
    }
}
