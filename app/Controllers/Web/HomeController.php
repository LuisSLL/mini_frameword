<?php
namespace App\Controllers\Web;

use Core\Response;

class HomeController {
    public function index() {
        // Renderiza la vista de inicio
        $html = '<h1>Bienvenido al Mini Framework PHP</h1>';
        Response::html($html);
    }
}