# Mini Framework PHP MVC

Este es un mini framework moderno en PHP basado en POO, arquitectura MVC, autoload PSR-4 y un ORM simple.

## Estructura

- `/public` → index.php (punto de entrada), .htaccess
- `/app/Controllers/Web` → Controladores para vistas web
- `/app/Controllers/API` → Controladores para API REST
- `/app/Models` → Modelos (ORM)
- `/app/Views/frontend` → Vistas para usuarios
- `/app/Views/backend` → Vistas para admin
- `/core` → Router, ORM, helpers, middleware, etc.
- `/routes/web.php` → Rutas web
- `/routes/api.php` → Rutas API
- `/config/config.php` → Configuración

## Ejemplo: Crear un modelo

```
<?php
namespace App\Models;
use Core\Model;
class Product extends Model {
    protected string $table = 'products';
    protected array $fillable = ['name', 'price', 'stock'];
}
```

## Ejemplo: Controlador API

```
<?php
namespace App\Controllers\API;
use App\Models\Product;
use Core\Request;
use Core\Response;
class ProductController {
    // ...ver código en /app/Controllers/API/ProductController.php
}
```

## Definir rutas

En `/routes/web.php`:
```
$this->get('/', 'HomeController@index');
```
En `/routes/api.php`:
```
$this->api('GET', '/products', 'ProductController@index');
```

## Retornar vistas o JSON
- Para vistas: `Response::html($html);` o `View::render('frontend/home', $data);`
- Para JSON: `Response::json($data);`

## Recibir datos por POST en la API
- Usar `$request->post()` para `application/x-www-form-urlencoded` o `$request->input()` para JSON.

## Probar CRUD con Postman
- GET    `/api/products`      → Listar productos
- GET    `/api/products/1`    → Ver producto
- POST   `/api/products`      → Crear producto (body: JSON)
- PUT    `/api/products/1`    → Actualizar producto (body: JSON)
- DELETE `/api/products/1`    → Eliminar producto

## Requisitos
- PHP 8+
- MySQL/MariaDB (crear tabla `products` con campos: id, name, price, stock)

## Nota
Este framework es ideal para aprender y como base para sistemas POS, tiendas online, paneles admin, o APIs para apps móviles y SPAs.