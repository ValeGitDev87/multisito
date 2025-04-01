<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
use Core\Router;
use Core\Database;
use Core\Session;
use Core\Config;

$mode = Config::getInstance()->get("mode");

/* if($mode === "test"){

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} */

// Usa il namespace della classe Router (definita in core/Router.php)

$session = new Session;
$session->start();

Database::getInstance();


// Istanzia il router, carica le rotte definite nel file di configurazione e dispatcha la richiesta
$router = new Router;
$router->loadRoutes(__DIR__ . '/../config/routes.php')->dispatch();

