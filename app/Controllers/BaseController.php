<?php
namespace App\Controllers;

class BaseController {
    /**
     * Renderizza una view all'interno di un layout.
     *
     * @param string $view  Nome della view (es. 'home' per app/Views/home.php)
     * @param array  $data  Dati da passare alla view
     */
    protected function view($view, $data = []) {
        // Estrai i dati in variabili
        extract($data);

        // Percorso corretto per la cartella views (partendo dalla root del progetto)
        $viewPath = realpath(__DIR__ . '/../../resources/views/' . $view . '.php');

        // Controllo se il file esiste
        if (!file_exists($viewPath)) {
            die("Errore: La view '$view' non esiste in $viewPath");
        }

        // Avvia l'output buffering per catturare l'output della view specifica
        ob_start();
        require_once $viewPath;
        $content = ob_get_clean();

        // Includi il layout e passa $content
        require_once realpath(__DIR__ . '/../../resources/views/layout.php');
    }
}
