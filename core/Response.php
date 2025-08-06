<?php
namespace Core;

/**
 * Response: facilita el envío de respuestas HTTP y JSON
 */
class Response {
    /**
     * Envía una respuesta JSON
     */
    public static function json($data, int $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    /**
     * Envía una respuesta HTML
     */
    public static function html($html, int $status = 200) {
        http_response_code($status);
        header('Content-Type: text/html');
        echo $html;
        exit;
    }
    /**
     * Redirige a otra URL
     */
    public static function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
}