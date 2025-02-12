<?php
namespace Core;

class Request {
    /**
     * Ottiene tutti i dati della richiesta (GET e POST)
     */
    public function all() {
        return array_merge($_GET, $_POST);
    }

    /**
     * Recupera un valore specifico dalla richiesta
     */
    public function input($key, $default = null) {
        $data = $this->all();
        return $data[$key] ?? $default;
    }

    /**
     * Recupera tutti i dati della richiesta POST
     */
    public function post($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? $default;
    }

    /**
     * Recupera tutti i dati della richiesta GET
     */
    public function get($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        return $_GET[$key] ?? $default;
    }

    /**
     * Controlla se la richiesta è di tipo POST
     */
    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Controlla se la richiesta è di tipo GET
     */
    public function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Sanitizza un valore per evitare attacchi XSS
     */
    public function sanitize($value) {
        return htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Recupera un valore dalla richiesta e lo sanitizza
     */
    public function safeInput($key, $default = null) {
        $value = $this->input($key, $default);
        return is_string($value) ? $this->sanitize($value) : $value;
    }
}
