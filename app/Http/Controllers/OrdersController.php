<?php

// app/Http/Controllers/OrdersController.php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function orders(string $aba, Request $request)
    {
        self::validateAba($aba);

        $ObApiOrderController = new ApiOrderController;
        $response = (array) $ObApiOrderController->orders($request);
        (array) $postVars = [];
        $actualpage = 1;

        return view('orders.selection', compact('aba', 'response', 'actualpage'))->with('postVars', $postVars);
    }
    public function filter(string $aba, Request $request)
    {
        self::validateAba($aba);
        $query = $request->query();

        $post = $request->post();
        $postVars = array_merge($query, $post);
        echo "<pre>";
        print_r($postVars);
        echo "</pre>";

        $ObApiOrderController = new ApiOrderController;
        $response = (array) $ObApiOrderController->orders($request);  

        return view('orders.selection', compact('response', 'aba', 'actualpage'))->with('postVars', $postVars);
    }

    public function validateAba(string $aba): void
    {
        $validAbaValues = ['Todos', 'Cancelados', 'Aberto'];

        if (!in_array($aba, $validAbaValues)) {
            abort(404); // Aborta a execução e exibe a página 404
        }
    }
}
