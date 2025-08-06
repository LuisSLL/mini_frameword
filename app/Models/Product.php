<?php
namespace App\Models;

use Core\Model;

/**
 * Modelo Product: representa la tabla 'products'
 */
class Product extends Model {
    protected string $table = 'products';
    protected array $fillable = ['name', 'price', 'stock'];
}