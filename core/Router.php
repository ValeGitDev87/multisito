<?php
namespace Core;

class Router {
    protected $routes = [];

    public function loadRoutes($routesFile) {
        $this->routes = require $routesFile;
        return $this;
    }

    public function dispatch() {
        // Estrae l'URI della richiesta
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Rimuove la parte di base se il progetto è in una sottocartella, ad esempio "/multisito"
        $base = '/multisito';
        if (strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }

        // Rimuove la barra finale, se presente, e assicura che l'URI sia "/" se vuoto
        $uri = rtrim($uri, '/');
        if ($uri === '') {
            $uri = '/';
        }

        // Debug (facoltativo): puoi stampare l'URI per verificare che sia corretto
        // echo "URI: " . $uri;

        // Verifica se la rotta esiste nell'array di rotte
        if (array_key_exists($uri, $this->routes)) {
            $controllerName = $this->routes[$uri]['controller'];
            $method = $this->routes[$uri]['method'];

            if (class_exists($controllerName)) {
                $controller = new $controllerName;
                if (method_exists($controller, $method)) {
                    return $controller->$method();
                } else {
                    echo "Il metodo $method non esiste in $controllerName";
                }
            } else {
                echo "Il controller $controllerName non esiste";
            }
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}
