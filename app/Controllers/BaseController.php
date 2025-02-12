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

        // Avvia l'output buffering per catturare l'output della view specifica
        ob_start();
        require_once __DIR__ . '/../resources/views/' . $view . '.php';
        $content = ob_get_clean();

        // Ora includi il layout, che stamperà header, il contenuto e il footer
        require_once __DIR__ . '/../resources/views/layout.php';
    }
}
