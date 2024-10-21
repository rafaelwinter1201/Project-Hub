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
            return view('errors.errors', compact('response'));
        }

        return view('Orders.orders', compact('response'));
    }
}
