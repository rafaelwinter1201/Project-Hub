<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
                return 'Pendente';
                break;
            case 'processing':
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
                    'processing',
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
                    'cancelled'
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

    public static function getTimeline($status)
    {
        $statusAtual = 'Enviado'; //self::getNameStatus($status);
        // Pendente > Processado > Facturado > Realizado > Enviado > Concluido

        // Cancelado | Fraude | Em Espera

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
}
