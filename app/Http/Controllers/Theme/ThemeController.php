<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    public function theme(){
        self::init();

        if($_SESSION['theme'] == 'dark') {
            $_SESSION['theme'] = 'light';
        } else {
            $_SESSION['theme'] = 'dark';
        }

        return response()->json(['theme' => $_SESSION['theme']]);
    }
    public static function init()
    {
        //verifica se existe sessão ativa, senão, cria uma
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
