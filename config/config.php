<?php
// config/config.php

return [
    'app' => [
        // In ambiente di sviluppo potresti usare '/multisito', mentre in produzione metterai l'URL completo
        'base_url' => '/multisito',  // In sviluppo: http://localhost/multisito
        // 'base_url' => 'https://tuo-dominio.com',  // In produzione
        'assets'   => [
            'css' => [
                // Puoi definire un array associativo in cui la chiave è un nome identificativo e il valore è il percorso del file CSS
                'main'  => '/multisito/public/css/main.css',
                'theme' => '/multisito/public/css/theme.css',
                'bootstrap' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'
            ],
            'js'  => [
                'app'    => '/multisito/public/js/app.js',
                'vendor' => '/multisito/public/js/vendor.js',
            ],
        ],

    ],
    'db' => [
        'host'     => 'localhost',
        'dbname'   => 'nome_database',
        'username' => 'utente',
        'password' => 'password',
        'charset'  => 'utf8mb4'
    ],
     'meta' => [
        // Titolo predefinito: questo può essere sovrascritto a livello di pagina nel controller se necessario
        'title'       => 'Il Mio Sito - Titolo Predefinito',
        // Descrizione predefinita per il sito (utile per la SEO)
        'description' => 'Questa è la descrizione predefinita del sito. Viene utilizzata per indicizzare il contenuto e per i social media, se non specificata diversamente per la pagina.',
        // Parole chiave (keywords) predefinite
        'keywords'    => 'sito, esempio, web, php, framework',
        // Altri meta tag utili:
        'viewport'    => 'width=device-width, initial-scale=1.0',
        'author'      => 'Valentino Sciarnè',
    ],

];
