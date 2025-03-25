<?php
namespace Core;

use Core\Config;

class Script {

    protected $config;

    public function __construct(Config $config)
    {        
        $this->config = $config; // Salva l'istanza della configurazione
    }

    public function  render($script, $includePath)
    {
        // Usa direttamente l'istanza già passata nel costruttore
        $baseUrl = $this->config->get('app.base_url');

        // Ottieni il percorso attuale della pagina
        $currentPath = trim($_SERVER['REQUEST_URI'], '/');

        // Costruisci l'URL del file che deve includere lo script
        $url = trim($baseUrl, '/') . $includePath;

        // Se siamo sulla pagina specificata, stampiamo il tag <script>
        if ($currentPath === trim($url, '/')) {
            echo '<script src="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $baseUrl . '/public/js/' . $script . '"></script>';
        }
    }
}
