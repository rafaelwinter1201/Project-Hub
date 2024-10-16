<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        self::init();
        if (isset($_SESSION['user']['username'])) {
            View::composer(['partials.navigator'], function ($view) {
                // Adicione suas variáveis aqui
                $view->with('username', $_SESSION['user']['username']);
                $view->with('perfil', $_SESSION['user']['perfil']);
            });
            
            View::composer('*', function ($view) {
                $view->with('theme', $_SESSION['theme']);
            });
        }
    }

    public static function init()
    {
        //verifica se existe sessão ativa, senão, cria uma
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
