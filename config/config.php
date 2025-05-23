<?php
// config/config.php

return [
    'app' => [
        // In ambiente di sviluppo potresti usare '/multisito', mentre in produzione metterai l'URL completo
        'base_url' => '/multisito',  // In sviluppo: http://localhost/multisito
        // 'base_url' => 'https://tuo-dominio.com',  // In produzione
        'assets'   => [
            'css' => [
                
                'login' => '/multisito/public/css/login.css',
                'register' => '/multisito/public/css/register.css',
                'main'  => '/multisito/public/css/main.css',
                'bootstrap' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css',
              
          
            
            ],
            
        'js'  => [
            'app'        => '/multisito/public/js/app.js',
            'bootstrap'  => 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
            'jquery'     => 'https://code.jquery.com/jquery-3.6.0.min.js',
            'sweetalert' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11'
        ],
        'mode'=>"developer"

        ],

    ],
    'db' => [
        'name' => 'multisito',
        'host'     => 'localhost',
        'dbname'   => 'multisito',
        'username' => 'root',
        'password' => 'root',
        'charset'  => 'utf8_general_ci'
    ],
     'meta' => [
        // Titolo predefinito: questo può essere sovrascritto a livello di pagina nel controller se necessario
        'title'       => 'Framework PHP',
        // Descrizione predefinita per il sito (utile per la SEO)
        'description' => 'Questa è la descrizione predefinita del sito. Viene utilizzata per indicizzare il contenuto e per i social media, se non specificata diversamente per la pagina.',
        // Parole chiave (keywords) predefinite
        'keywords'    => 'sito, esempio, web, php, framework',
        // Altri meta tag utili:
        'viewport'    => 'width=device-width, initial-scale=1.0',
        'author'      => 'Valentino Sciarnè',
    ],


        // ... altre configurazioni
        'mail' => [

            'host'        => 'sandbox.smtp.mailtrap.io',
            'username'    => 'd5f1d4a4478b08',
            'password'    => '15828ff6e30676',
            'port'        => 2525, // oppure 587, a seconda della configurazione Mailtrap
            'smtp_secure' => null, // oppure 'tls'
            'from_email'  => 'noreply@tuosito.com',
            'from_name'   => 'Il Mio Sito'
        ],


    
];
