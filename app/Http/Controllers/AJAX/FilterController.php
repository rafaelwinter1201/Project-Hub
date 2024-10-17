<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\ApiOrderController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $ObApiOrderController = new ApiOrderController;
        $response = (array) $ObApiOrderController->orders($request);

        if (isset($response['httpStatus']) && $response['httpStatus'] == 401) {
            //dps trato isso
            echo 'You are not authorized to';
            exit;
        } elseif (!$response['body']){
            //dps trato isso
            echo 'Nenhum pedido encontrado com estes filtros!';
            exit;
        }
        
        //aqui vai ficar a parte de paginação
        $actualpage = $request->query('page') ? $request->query('page') : 1;

        return view('orders.orders', compact('response', 'actualpage'));
    }
}
