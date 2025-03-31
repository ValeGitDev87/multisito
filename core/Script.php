<?php
namespace Core;

use Core\Config;

class Script {

    protected $config;

    public function __construct(Config $config)
    {        
        $this->config = $config; // Salva l'istanza della configurazione
    }

    public function render($script, $includePath)
    {
        $baseUrl = $this->config->get('app.base_url');
    
        // Estrai solo il path della URL corrente, senza query string
        $currentPath = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    
        // Normalizza l'includePath: rimuovi eventuali slash all'inizio e alla fine
        $includePath = trim($includePath, '/');
    
        // Costruisci il percorso atteso: ad esempio "multisito/register"
        // Se il baseUrl è "/multisito", allora trim($baseUrl, '/') restituisce "multisito"
        $expectedPath = trim($baseUrl, '/') . '/' . $includePath;
        $expectedPath = trim($expectedPath, '/');
    
        // Debug (rimuovi quando funziona)
        // echo "currentPath: " . $currentPath . "<br>expectedPath: " . $expectedPath;
    
        if ($currentPath === $expectedPath) {
            echo '<script src="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $baseUrl . '/public/js/' . $script . '"></script>';
        }
    }
    
}
