<?php
// Definición de rutas API RESTful
// $this se refiere al Router

// Ejemplo: CRUD de productos
$this->api('GET', '/products', 'ProductController@index'); // Listar productos
$this->api('GET', '/products/{id}', 'ProductController@show'); // Ver producto
$this->api('POST', '/products', 'ProductController@store'); // Crear producto
$this->api('PUT', '/products/{id}', 'ProductController@update'); // Actualizar producto
$this->api('DELETE', '/products/{id}', 'ProductController@destroy'); // Eliminar producto