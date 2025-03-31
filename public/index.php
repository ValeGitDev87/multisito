<?php
// Attivazione del reporting degli errori per lo sviluppo (da disattivare in produzione)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Includi l'autoloader generato da Composer
require_once __DIR__ . '/../vendor/autoload.php';


// Usa il namespace della classe Router (definita in core/Router.php)
use Core\Router;
use Core\Database;
use Core\Session;

$session = new Session;
$session->start();

Database::getInstance();


// Istanzia il router, carica le rotte definite nel file di configurazione e dispatcha la richiesta
$router = new Router;
$router->loadRoutes(__DIR__ . '/../config/routes.php')->dispatch();



