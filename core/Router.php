<?php
namespace Core;

/**
 * Router: gestiona las rutas web y API
 * Permite definir rutas y despachar controladores
 */
class Router {
    private array $routes = [];
    private array $apiRoutes = [];

    /**
     * Carga las rutas desde los archivos de rutas
     */
    public function loadRoutes() {
        require __DIR__ . '/../routes/web.php';
        require __DIR__ . '/../routes/api.php';
    }

    /**
     * Define una ruta web
     */
    public function get(string $uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }
    public function post(string $uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }
    public function put(string $uri, $action) {
        $this->routes['PUT'][$uri] = $action;
    }
    public function delete(string $uri, $action) {
        $this->routes['DELETE'][$uri] = $action;
    }

    /**
     * Define una ruta API (prefijo /api)
     */
    public function api(string $method, string $uri, $action) {
        $this->apiRoutes[$method]['/api' . $uri] = $action;
    }

    /**
     * Despacha la ruta solicitada al controlador correspondiente
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        if ($uri === '') $uri = '/';

        // ¿Es una ruta API?
        if (str_starts_with($uri, '/api')) {
            $action = $this->apiRoutes[$method][$uri] ?? null;
        } else {
            $action = $this->routes[$method][$uri] ?? null;
        }

        if ($action) {
            if (is_callable($action)) {
                return $action();
            } elseif (is_string($action)) {
                // Formato: Controlador@metodo
                [$controller, $methodName] = explode('@', $action);
                $namespace = str_starts_with($uri, '/api') ? 'App\\Controllers\\API\\' : 'App\\Controllers\\Web\\';
                $controllerClass = $namespace . $controller;
                if (class_exists($controllerClass)) {
                    $ctrl = new $controllerClass();
                    return $ctrl->$methodName();
                } else {
                    http_response_code(500);
                    echo "Controlador no encontrado: $controllerClass";
                }
            }
        }
        // Ruta no encontrada
        http_response_code(404);
        echo "Ruta no encontrada: $uri";
    }
}