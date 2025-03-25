<?php
namespace App\Middlewares;

use Core\Session;
use Core\Config;

class GuestMiddleware {
    public static function handle() {
        $baseUrl = Config::getInstance()->get('app.base_url', '/');

        // Se l'utente è già loggato → redirect alla home
        if (Session::has('user_id')) {
            header("Location: {$baseUrl}/");
            exit;
        }

        return true;
    }
}
