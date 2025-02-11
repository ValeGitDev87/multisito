<?php
namespace Core;

class Router {
    /**
     * Array associativo che contiene le rotte.
     * Il formato atteso è:
     * [
     *    'uri' => [
     *         'controller' => 'NomeCompletoDelController',
     *         'method' => 'nomeDelMetodo'
     *    ],
     *    ...
     * ]
     */
    protected $routes = [];

    /**
     * Carica le rotte da un file di configurazione.
     *
     * @param string $routesFile Il percorso del file di rotte (es. config/routes.php)
     * @return $this
     */
    public function loadRoutes($routesFile) {
        $this->routes = require $routesFile;
        return $this;
    }

    /**
     * Esegue l'instradamento della richiesta.
     */
    public function dispatch() {
        // Estrae l'URI della richiesta
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Rimuove la barra finale se presente, salvo il caso che sia solo "/"
        $uri = rtrim($uri, '/');
        if ($uri === '') {
            $uri = '/';
        }

        // Verifica se la rotta esiste nell'array di rotte
        if (array_key_exists($uri, $this->routes)) {
            $controllerName = $this->routes[$uri]['controller'];
            $method = $this->routes[$uri]['method'];

            // Verifica se la classe esiste e se il metodo è presente
            if (class_exists($controllerName)) {
                $controller = new $controllerName;
                if (method_exists($controller, $method)) {
                    // Richiama il metodo del controller
                    return $controller->$method();
                } else {
                    echo "Il metodo $method non esiste in $controllerName";
                }
            } else {
                echo "Il controller $controllerName non esiste";
            }
        } else {
            // Se la rotta non viene trovata, invia un 404
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}
