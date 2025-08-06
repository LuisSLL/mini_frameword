<?php
// Front Controller: punto de entrada de todas las peticiones

// Cargar el autoload de Composer (PSR-4)
require_once __DIR__ . '/../vendor/autoload.php';

// Cargar configuración global
require_once __DIR__ . '/../config/config.php';

// Iniciar el router principal
use Core\Router;

$router = new Router();
$router->loadRoutes(); // Carga rutas desde /routes
$router->dispatch(); // Ejecuta la ruta correspondiente

// Nota: El router y las clases Core se implementarán en /core