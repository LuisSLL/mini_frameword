<?php
namespace App\Controllers\Web;

use Core\Response;

class AdminController {
    public function index() {
        // Renderiza la vista de admin
        $html = '<h1>Panel de Administrador</h1>';
        Response::html($html);
    }
}