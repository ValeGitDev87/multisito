<?php
namespace App\Middlewares;

use App\Models\User;




class VerifyTokenMiddleware {

    public static function handle() {
        
        

        $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($token) {
            // Il token esiste, prosegui con la logica
        } else {
            // Il token non è stato passato o non è valido
            echo "<div style='padding:50px; margin-top:200px; width:100%; background-color:red; color:white;'>
                <h1 style='text-align:center; font-weight:bold;'>Attenzione Token Mancante</h1>
             </div>";
            exit;
        }
        
        User::controlToken($token);
        

        return true;
    }
}
