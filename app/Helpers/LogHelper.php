<?php

namespace App\Helpers;

class LogHelper {
    // Directory dove verranno salvati i log
    protected static $logDir = __DIR__ . '/../logs';

    /**
     * Registra un messaggio di log in un file specifico.
     *
     * @param string $message Il messaggio da registrare.
     * @param string $file Il nome del file di log (default: "app.log").
     */
    public static function log_mail(string $message, string $file = 'mail.log') {
        // Crea la cartella dei log se non esiste
        if (!file_exists(self::$logDir)) {
            mkdir(self::$logDir, 0755, true);
        }

        $date = date('Y-m-d H:i');
        $fullMessage = "[$date] $message" . PHP_EOL;
        $filePath = self::$logDir . '/' . $file;

        // Scrivi il messaggio nel file, aggiungendolo in append
        file_put_contents($filePath, $fullMessage, FILE_APPEND);
    }
}
