<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiController extends Controller
{
    public function postLogin(array $login)
    {
        $client = new Client();
        
        //verifica ambiente
        $apiurl = getenv('APIURL');
        $password = $login['password'];
        

        $data = [
            'username' => $login['username'],
            'password' => $password
        ];

        try {
            $response = $client->request('POST', $apiurl . '/auth/login', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException  $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody()->getContents();
                return [
                    'body' => json_decode($body, true),
                ];
            }
            throw $e;
        }
    }
}
