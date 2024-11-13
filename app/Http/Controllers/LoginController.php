<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{

    public static function init()
    {
        //verifica se existe sessão ativa, senão, cria uma
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * rota de GET /
     *
     * @return string
     */
    public function showLogin(){
        if(self::isLogged()) {
            return redirect()->route('orders');
            // return redirect()->route('dashboard');
        }
        
        return view('Login.Login',[
            'mensagem' => ''
        ]);
    }

    /**
     * Rota de POST /
     *
     * @param Request $request
     * @return string
     */
    public function Login(Request $request){
        self::RedirectIfIsLogged();
        $login = [
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ];
        
        $ObApiController = new ApiController;
        $response = $ObApiController->postLogin($login);
        
        if(!isset($response['body'])){
            self::startSession($response);
            //return redirect()->route('dashboard');
            return redirect()->route('orders');
        }
        return view('Login.Login',[
            'user' => $login['username'],
            'mensagem' => 'Usuário e/ou senha incorreto(s).'
        ]);
    }

    public function startSession($userData): void
    {
        //inicia sessão
        self::init();
        
        //armazena dados do usuário na sessão
        $username = $userData['descricao'];
        $perfil = $userData['perfil'];
        $webToken = $userData['web_token'];

        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['perfil'] = $perfil;
        $_SESSION['user']['webToken'] = $webToken;
        $_SESSION['theme'] = 'light';
    }
    /**
     * MÉTODO RESPONSAVEL POR VERIFICAR SE O USUÁRIO ESTÁ LOGADO
     *
     * @return boolean
     */
    public static function isLogged()
    {
        self::init();

        if(!empty($_SESSION['user']['webToken'])) {
            return true;
        }
    }
    
    public static function RedirectIfIsLogged()
    {
        if(self::isLogged()) {
            return redirect()->route('orders');
            //return redirect()->route('dashboard');
        }
    }
}
