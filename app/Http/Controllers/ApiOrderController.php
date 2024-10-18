<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Util;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function orders(Request $request, $id = null)
    {
        self::init();

        $post = (array) $request->post();

        if (isset($post['buttonPressed'])) {
            if ($post['buttonPressed'] === 'botaoProximo') {
                $post['page'] = $post['page'] + 1;
            } elseif ($post['buttonPressed'] === 'botaoAnterior') {
                $post['page'] = $post['page'] - 1;
            }
        }

        $params = (string) self::getParams($post, $id);

        $client = new Client();

        try {
            $response = $client->request('GET', getenv('APIURL') . '/orders' . $params, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $_SESSION['user']['webToken'] // Utiliza o token da sessão
                ]
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            return [
                'httpStatus' => $response->getStatusCode(),
                'body' => $body,
                'x-items-per-page' => isset($post['limit']) ? $post['limit'] : 10,
                'x-total-items' => $response->getHeaders()['X-Total-Items'][0],
                'x-total-pages' => $response->getHeaders()['X-Total-Pages'][0],
                'info' => isset($post['page']) ? $post['page'] : '1'
            ];
        } catch (RequestException  $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody()->getContents();
                return [
                    'httpStatus' => $response->getStatusCode(),
                    'body' => "false"
                ];
            }
            throw $e;
        }
    }

    public function getParams(array $vars, $id = null)
    {

        $filtros = [];

        $limit = isset($vars['limit']) ? $vars['limit'] : 10; // Default limit
        $filtros[] = 'limit=' . $limit;

        $page = isset($vars['page']) ? $vars['page'] : 1;
        $filtros[] = 'page=' . $page;

        if (!empty($vars['search'])) { //caso venha um id do filtro
            $filtros[] = 'platform_code=' . $vars['search'];
        } elseif (isset($id)) { //caso venha o $id para o detalhes
            $idpedido = substr($id, 2); //remove id plataforma para busca
            $filtros[] = 'platform_code=' . $idpedido;
        }

        if (!empty($vars['startDate'])) {
            $filtros[] = 'criacao_de=' . $vars['startDate'];
        }

        if (!empty($vars['endDate'])) {
            $filtros[] = 'criacao_ate=' . $vars['endDate'];
        }

        if (!empty($vars['selectedOptions'])) {
            foreach ($vars['selectedOptions'] as $status) {
                $statusDecodificated = Util::getStatusName($status);
                if (is_array($statusDecodificated)) {
                    foreach ($statusDecodificated as $stat) {
                        $filtros[] = 'status=' . strtolower($stat); // Cria o filtro para cada posição
                    }
                }
            }
        }

        if (!empty($vars['fornecedor'])) {
            $filtros[] = 'fornecedor=' . $vars['fornecedor'];
        }
        // Combine pagination and filters
        $params = '';

        if (!empty($filtros)) {
            $params .= '?' . implode('&', $filtros);
        }
        return $params;
    }
    public static function init()
    {
        //verifica se existe sessão ativa, senão, cria uma
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
