<?php
namespace Core;

class Session {
    /**
     * Avvia la sessione se non è già stata avviata
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Imposta un valore nella sessione
     */
    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Recupera un valore dalla sessione
     */
    public static function get($key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Controlla se un valore esiste nella sessione
     */
    public static function has($key)
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Rimuove un valore dalla sessione
     */
    public static function remove($key)
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Distrugge completamente la sessione
     */
    public static function destroy()
    {
        self::start();
        session_unset();
        session_destroy();
    }
}
