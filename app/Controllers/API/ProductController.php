<?php
namespace App\Controllers\API;

use App\Models\Product;
use Core\Request;
use Core\Response;

/**
 * Controlador API para productos (CRUD)
 */
class ProductController {
    private $product;
    private $request;

    public function __construct() {
        $this->product = new Product();
        $this->request = new Request();
    }

    // GET /api/products
    public function index() {
        $products = $this->product->all();
        Response::json($products);
    }

    // GET /api/products/{id}
    public function show() {
        $id = $this->getIdFromUri();
        $product = $this->product->find($id);
        if ($product) {
            Response::json($product);
        } else {
            Response::json(['error' => 'Producto no encontrado'], 404);
        }
    }

    // POST /api/products
    public function store() {
        $data = $this->request->post();
        if (empty($data)) {
            $data = $this->request->input(); // Para JSON
        }
        $product = $this->product->create($data);
        Response::json($product, 201);
    }

    // PUT /api/products/{id}
    public function update() {
        $id = $this->getIdFromUri();
        $data = $this->request->input();
        $product = $this->product->update($id, $data);
        Response::json($product);
    }

    // DELETE /api/products/{id}
    public function destroy() {
        $id = $this->getIdFromUri();
        $ok = $this->product->delete($id);
        Response::json(['deleted' => $ok]);
    }

    // Helper para extraer el ID de la URI
    private function getIdFromUri() {
        $uri = $this->request->uri();
        $parts = explode('/', trim($uri, '/'));
        return end($parts);
    }
}