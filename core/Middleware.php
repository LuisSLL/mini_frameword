<?php
namespace Core;

/**
 * Middleware base: extiende para crear middlewares personalizados
 */
abstract class Middleware {
    abstract public function handle(callable $next);
}

/**
 * Ejemplo: Middleware de autenticación
 */
class AuthMiddleware extends Middleware {
    public function handle(callable $next) {
        // Aquí puedes verificar si el usuario está autenticado
        $authenticated = isset($_SESSION['user']);
        if ($authenticated) {
            return $next();
        } else {
            http_response_code(401);
            echo 'No autorizado';
            exit;
        }
    }
}