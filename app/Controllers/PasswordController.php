<?php
namespace App\Controllers;

use App\Helpers\MailHelper; 
use Core\Request;
use Core\Config;
use App\Models\User; 

class PasswordController extends BaseController {

    protected $request;

    public function __construct(Request $request) {

        $this->request = $request;
    }

    public function forgotPassword() {

        if ($this->request->isPost()) {
            $data = $this->request->all();
            $email = trim($data['email'] ?? '');
            
            // Controlla se l'email è valida e se l'utente esiste
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Email non valida.']);
                exit;
            }
            
            $user = User::findByEmail($email);
            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'Email non trovata.']);
                exit;
            }
            
            // Genera un token per il reset password (puoi usare anche una funzione più robusta)
            $token = bin2hex(random_bytes(16));
            
            // In un'app reale, dovresti salvare il token e una data di scadenza nel database, associandoli all'utente.
            // Per questo esempio, ipotizziamo di salvare il token direttamente sul record dell'utente:
            $user->reset_token = $token;
            // Opzionale: salva anche una scadenza (esempio: 1 ora dal reset)
            $user->reset_token_expires = date("Y-m-d H:i:s", strtotime("+1 hour"));
            $user->save();
            
            // Costruisci il link di reset: usa baseUrl per generare l'URL
            $baseUrl = Config::getInstance()->get('app.base_url');
            $resetLink = rtrim($baseUrl, '/') . "/reset-password?token=" . $token;
            
            // Prepara l'email
            $subject = "Reset della password";
            $body = "<p>Ciao " . htmlspecialchars($user->name) . ",</p>
                     <p>Hai richiesto di resettare la tua password. Clicca sul link qui sotto per farlo:</p>
                     <p><a href='" . $resetLink . "'>" . $resetLink . "</a></p>
                     <p>Se non hai richiesto il reset, ignora questa email.</p>";
            $altBody = "Ciao " . $user->name . ", visita questo link per resettare la tua password: " . $resetLink;
            
            // Invia l'email tramite il MailHelper
            $mailHelper = new MailHelper();
            if ($mailHelper->send($user->email, $subject, $body, $altBody)) {
                echo json_encode(['success' => true, 'message' => "Email per il reset inviata! Controlla la tua casella."]);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => "Errore durante l'invio dell'email."]);
            }
            exit;
        }
        
        // Se GET, mostra il form di richiesta reset
        $this->view('forgot_password', ['title' => 'Password Dimenticata']);
    }

    public function resetPassword()
    {
        $this->view('reset_password', ['title' => 'Rimposta la Password']);
    }
}
