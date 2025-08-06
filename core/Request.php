<?php
namespace Core;

/**
 * Request: encapsula la petición HTTP
 */
class Request {
    /**
     * Obtiene datos de GET
     */
    public function get(string $key = null) {
        if ($key) return $_GET[$key] ?? null;
        return $_GET;
    }
    /**
     * Obtiene datos de POST
     */
    public function post(string $key = null) {
        if ($key) return $_POST[$key] ?? null;
        return $_POST;
    }
    /**
     * Obtiene datos de PUT/DELETE (JSON)
     */
    public function input() {
        $data = file_get_contents('php://input');
        $json = json_decode($data, true);
        return $json ?: [];
    }
    /**
     * Obtiene el método HTTP
     */
    public function method() {
        return $_SERVER['REQUEST_METHOD'];
    }
    /**
     * Obtiene la URI solicitada
     */
    public function uri() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}