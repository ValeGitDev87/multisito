<?php
// public/index.php

// Attivazione del reporting degli errori in ambiente di sviluppo
ini_set('display_errors', 1);
error_reporting(E_ALL);



// Messaggio temporaneo per verificare che l'autoloading funzioni
echo "Autoloading funzionante!";

// Da qui in poi, potrai istanziare classi del tuo framework, ad esempio:
// $router = new Core\Router();
// ecc.
