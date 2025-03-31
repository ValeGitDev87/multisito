<?php
namespace App\Controllers;

use Core\Request;
use Core\Session;
use App\Models\User;
use Core\Config;

class AuthController extends BaseController {

    protected $request;
    public function login(Request $request) 
    {

        if ($request->isPost()) {

            header('Content-Type: application/json');

            $email = $request->post('email');
            $password = $request->post('password');
            $user = User::findByEmail($email);

            if ($user && sodium_crypto_pwhash_str_verify($user->password, $password)) {
                // Login riuscito: salviamo l'utente nella sessione
                Session::set('user_id', $user->id);
                Session::set('user_name', $user->name);
                Session::set('user_surname', $user->surname);


                echo json_encode(['success' => true, 'message' => "Benvenuto, {$user->name}!"]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Credenziali non valide.']);
            }
            exit;
        }

        $this->view('login', ['title' => 'Login']);
    }

    public function logout() {

        $baseUrl = Config::getInstance()->get('app.base_url', '/');

        Session::destroy();

        header("Location: {$baseUrl}/");

        exit;
    }
}
