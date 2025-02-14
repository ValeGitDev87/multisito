<?php
namespace App\Controllers;

use Core\Database;
use ORM;

class DatabaseTestController extends BaseController 
{
    public function index()
    {
        Database::getInstance(); // Avvia la connessione

        try {
            $result = ORM::for_table('users')->find_one();
            $message = $result ? "Connessione riuscita! Utente trovato: " . $result->name : "Connessione OK ma nessun utente trovato.";
            
        } catch (\Exception $e) {
            $message = "Errore di connessione: " . $e->getMessage();
        }

        $this->view('test', ['title' => 'Test DB', 'message' => $message],true);
    }
}
