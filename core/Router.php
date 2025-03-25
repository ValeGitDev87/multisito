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
    
   

    private function executeRoute($routeOptions, $params = []) {
        
        $controllerName = $routeOptions['controller'];
        $method = $routeOptions['method'];
        
        // Verifica se vogliamo iniettare dipendenze (default: true)
        $injectDependencies = true;
        if (isset($routeOptions['injectDependencies']) && $routeOptions['injectDependencies'] === false) {
            $injectDependencies = false;
        }
    
        if (!class_exists($controllerName)) {
            echo "Errore: Il controller $controllerName non esiste";
            return;
        }
    
        // Usa Reflection per ottenere informazioni sulla classe
        $reflector = new \ReflectionClass($controllerName);
        $constructor = $reflector->getConstructor();
        $dependencies = [];
    
        if ($constructor) {
            foreach ($constructor->getParameters() as $param) {
                $paramClass = $param->getType() ? $param->getType()->getName() : null;
    
                if ($paramClass && class_exists($paramClass)) {
                    // Proviamo a iniettare la dipendenza nel costruttore
                    $dependencies[] = new $paramClass();
                } elseif (!$param->isOptional()) {
                    echo "Errore: Non posso risolvere la dipendenza {$param->getName()} in $controllerName";
                    return;
                }
            }
        }
        
        // Middleware: se definito, eseguilo prima del controller
        if (isset($routeOptions['middleware'])) {
            $middlewareClass = $routeOptions['middleware'];
            if (class_exists($middlewareClass) && method_exists($middlewareClass, 'handle')) {
                $middlewareClass::handle(); // Se il middleware fa un redirect o blocca, qui si ferma
            }
        }

        // Istanzia il controller con o senza dipendenze
        $controller = !empty($dependencies) ? $reflector->newInstanceArgs($dependencies) : new $controllerName();
    
        if (method_exists($controller, $method)) {
            // Se abbiamo attivato l'iniezione automatica, controlliamo la firma del metodo
            if ($injectDependencies) {
                $methodReflection = new \ReflectionMethod($controller, $method);
                $methodParameters = $methodReflection->getParameters();
    
                // Se il metodo richiede più parametri di quelli forniti...
                if (count($methodParameters) > count($params)) {
                    foreach ($methodParameters as $i => $param) {
                        if ($i >= count($params)) { // questo parametro non è stato fornito
                            $paramType = $param->getType();
                            // Se il parametro è di tipo Core\Request, iniettiamo un'istanza
                            if ($paramType && $paramType->getName() === 'Core\Request') {
                                $params[] = new \Core\Request();
                            }
                            // Aggiungi qui altre condizioni per altri tipi se necessario
                        }
                    }
                }
            }
            // Chiamata finale del metodo con i parametri (eventualmente integrati)
            call_user_func_array([$controller, $method], $params);
        } else {
            echo "Errore: Il metodo $method non esiste in $controllerName";
        }
    }
    
    
    
}


