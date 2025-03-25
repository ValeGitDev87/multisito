<?php
namespace App\Middlewares;

use Core\Session;
use Core\Config;

class AuthMiddleware {

  
    public static function handle() {
        // Se l'utente non è loggato, reindirizzalo al login

        $baseUrl = Config::getInstance()->get('app.base_url', '/');
        if (!Session::has('user_id')) {
            
            header("Location: {$baseUrl}/login");

            exit;
        }

     
        return true;
   

    }
}
