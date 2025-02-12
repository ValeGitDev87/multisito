<?php
namespace App\Controllers;

use Core\Request;
use Core\Session;
use App\Models\User;

class AuthController extends BaseController
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function login()
    {
        if ($this->request->isPost()) {
            $email = $this->request->post('email');
            $user = User::findByEmail($email);

            if ($user) {
                // Simuliamo il login (in un caso reale dovremmo verificare una password hashata)
                Session::set('user_id', $user->id);
                Session::set('user_name', $user->name);
                echo json_encode(['success' => true, 'message' => "Benvenuto, {$user->name}!"]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Credenziali non valide.']);
            }
            exit;
        }

        $this->view('login', ['title' => 'Login']);
    }

    public function logout()
    {
        Session::destroy();
        header("Location: /");
        exit;
    }
}
