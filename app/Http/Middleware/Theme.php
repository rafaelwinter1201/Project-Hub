<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Theme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        self::init();
        //$_SESSION['theme'] = 'light';

        return $next($request);
    }

    public static function init()
    {
        //verifica se existe sessão ativa, senão, cria uma
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
