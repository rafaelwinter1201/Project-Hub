<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Response;

class LabelController extends Controller
{
    public function label($id)
    {
        self::init();
        $client = new Client();

        // api params
        $params = [
            'idnfe' => $id,
            //'idnfe' => '35240807390064000195550010000374921090636834',
            'base64' => 't'
        ];

        //api get img64 
        try {
            $response = $client->request('GET', getenv('APIURLCLIENT') . '/api/MILLENIUM_LOG.DOCUMENTOS.ETIQUETA_TRANSPORTE?' . http_build_query($params));
            if ($response->getStatusCode() == 200) {
                // Verifica se encontramos o que queríamos
                if (preg_match('/<!\[CDATA\[(.*?)\]\]>/', $response->getBody(), $matches)) {
                    $cdataContent = $matches[1]; // O conteúdo está na posição 1 do array de matches
                    $date = $cdataContent; // Exibe o conteúdo capturado
                } else {
                    $date = 'Conteúdo CDATA não encontrado.';
                }
                // Decodifique a string base64
                $pdfContent = base64_decode($date);

                // Crie a resposta com o conteúdo do PDF
                $response = new Response($pdfContent);
                $response->header('Content-Type', 'application/pdf');
                $response->header('Content-Disposition', 'inline; filename="documento.pdf"'); // Para abrir no navegador
                // $response->header('Content-Disposition', 'attachment; filename="documento.pdf"'); // Para baixar o arquivo

                return $response;
            }
        } catch (RequestException  $e) {
            echo 'Erro: ' . $e->getMessage();
            if ($e->hasResponse()) {
                echo ' Resposta: ' . $e->getResponse()->getBody();
            }
        }
    }
    public static function init()
    {
        //verifica se existe sessão ativa, senão, cria uma
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
