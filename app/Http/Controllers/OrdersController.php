<?php

// app/Http/Controllers/OrdersController.php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function orders(Request $request)
    {
        $ObApiOrderController = new ApiOrderController;
        $response = (array) $ObApiOrderController->orders($request);
        //inicia com valores padrão
        (array) $filtros = [];
        $actualpage = 1;
        echo "essa página é um get";

        return view('orders.selection', compact('response', 'actualpage', 'filtros'));
    }
    public function filter(Request $request)
    {
        echo "essa página é um post";
        
        $ObApiOrderController = new ApiOrderController;
        $response = (array) $ObApiOrderController->orders($request);

        $actualpage = $response;
        $filtros = $request->post();

        return view('orders.selection', compact('response', 'actualpage', 'filtros'));
    }
}
