<?php
namespace App\Controllers;

use Core\Request;
use Core\Validator;
use App\Models\User;
use ORM;

class RegisterController extends BaseController {
    protected $request;
    protected $validator;

    public function __construct(Request $request, Validator $validator) {
        $this->request = $request;
        $this->validator = $validator;
    }

    public function register() {
        if ($this->request->isPost()) {
            $data = $this->request->all();

            //  Definiamo le regole di validazione
            $rules = [
                'name'     => 'required|min:3|max:50',
                'surname'  => 'required|min:3|max:50',
                'email'    => 'required|email|unique:users', //  Controllo UNIQUE su tabella `users`
                'password' => 'required|min:6'
            ];

            //  Applichiamo la validazione
            if (!$this->validator->validate($data, $rules)) {
                echo json_encode(['success' => false, 'message' => implode(" ", array_map(fn($e) => implode(" ", $e), $this->validator->errors()))]);
                exit;
            }

            //  Hash della password con Libsodium
            $hashedPassword = sodium_crypto_pwhash_str(
                $data['password'],
                SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
                SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
            );

            //  Salviamo l'utente nel database
            $user = ORM::for_table('users')->create();
            $user->name = $data['name'];
            $user->surname = $data['surname'];
            $user->email = $data['email'];
            $user->password = $hashedPassword;
            $user->save();

            echo json_encode(['success' => true, 'message' => 'Registrazione completata! Ora puoi accedere.']);
            exit;
        }

        $this->view('register', ['title' => 'Registrati']);
    }
}
 