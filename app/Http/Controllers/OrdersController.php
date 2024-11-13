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

        if (!empty($response['msg'])) {
            return response()->view('errors.fallback', [
                'code' => $response['httpStatus'],
                'message' => $response['msg'],
            ], 404);
        }

        return view('orders.selection', compact('response', 'actualpage', 'filtros'));
    }
    public function filter(Request $request)
    {                
        $ObApiOrderController = new ApiOrderController;
        $response = (array) $ObApiOrderController->orders($request);

        $actualpage = 1;
        $filtros = $request->post();

        return view('orders.selection', compact('response', 'actualpage', 'filtros'));
    }
}
