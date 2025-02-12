<?php
namespace Core;

class Router {
    protected $routes = [];

    public function loadRoutes($routesFile) {
        $this->routes = require $routesFile;
        return $this;
    }

    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/');
    
        // Leggiamo il base URL dal config
        $config = require __DIR__ . '/../config/config.php';
        $baseUrl = $config['app']['base_url'];
    
        // Se l'URI inizia con il base_url, lo rimuoviamo
        if ($baseUrl !== '/' && strpos($uri, $baseUrl) === 0) {
            $uri = substr($uri, strlen($baseUrl));
        }
    
        // Se l'URI è vuoto, lo settiamo a "/"
        if ($uri === '') {
            $uri = '/';
        }
    
    
    
        // Controllo delle rotte statiche
        if (array_key_exists($uri, $this->routes)) {
            $this->executeRoute($this->routes[$uri]);
            return;
        }
    
        // Controllo delle rotte dinamiche
        foreach ($this->routes as $route => $options) {
            $pattern = preg_replace('/\{(\w+)\}/', '(\w+)', $route);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);
                $this->executeRoute($options, $matches);
                return;
            }
        }
    
        // Se nessuna rotta corrisponde, mostra 404
        http_response_code(404);
        echo "<pre>404 Not Found - URI richiesto: $uri</pre>";
    }
    
   
    private function executeRoute($routeOptions, $params = [])
    {
        $controllerName = $routeOptions['controller'];
        $method = $routeOptions['method'];
    
        if (class_exists($controllerName)) {
            // 🔥 Usa Reflection per ottenere il costruttore del controller
            $reflector = new \ReflectionClass($controllerName);
            $constructor = $reflector->getConstructor();
            $dependencies = [];
    
            if ($constructor) {
                foreach ($constructor->getParameters() as $param) {
                    $paramClass = $param->getType() ? $param->getType()->getName() : null;
                    if ($paramClass && class_exists($paramClass)) {
                        // Se la classe esiste, la creiamo automaticamente
                        $dependencies[] = new $paramClass();
                    } else {
                        $dependencies[] = null; // Se non esiste, passa null
                    }
                }
            }
    
            // 🚀 Istanzia il controller con le dipendenze richieste
            $controller = $reflector->newInstanceArgs($dependencies);
    
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
                return;
            } else {
                echo "Errore: Il metodo $method non esiste in $controllerName";
            }
        } else {
            echo "Errore: Il controller $controllerName non esiste";
        }
    }
    
}
