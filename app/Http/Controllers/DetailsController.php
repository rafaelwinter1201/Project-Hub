<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function details($id, Request $request){
        $ObApiOrderController = new ApiOrderController;
        $response = (array) $ObApiOrderController->orders($request, $id);
        $pedido = $response['body'][0];
        return view('details.details', compact('id', 'pedido'));
    }
}
