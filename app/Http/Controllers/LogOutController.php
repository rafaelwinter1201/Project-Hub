<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogOutController extends Controller
{
    /**
     * MÉTODO RESPONSAVEL POR ENCERRAR A SESSÃO
     */
    public static function logOut()
    {
        self::init();

        unset($_SESSION['user']);

        return redirect('/');
    }
    public static function init()
    {
        //verifica se existe sessão ativa, senão, cria uma
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
