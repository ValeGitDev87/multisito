<?php
namespace Core;

class Config {
    // Istanza singleton
    protected static $instance = null;

    // Array di configurazioni
    protected $settings = [];

    // Costruttore privato per evitare istanziazioni esterne
    private function __construct() {
        // Carica il file di configurazione
        $this->settings = require __DIR__ . '/../config/config.php';
    }

    // Metodo per ottenere l'istanza unica
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    // Metodo per recuperare una configurazione usando la dot notation, ad esempio 'app.base_url'
    public function get($key, $default = null) {
        $keys = explode('.', $key);
        $value = $this->settings;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $default;
            }
        }
        return $value;
    }
}
