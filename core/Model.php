<?php
namespace Core;

use Core\Database;

/**
 * Model: ORM simple para interactuar con la base de datos
 * Hereda esta clase para tus modelos
 */
abstract class Model {
    protected string $table; // Nombre de la tabla
    protected string $primaryKey = 'id';
    protected array $fillable = []; // Campos permitidos para asignación masiva

    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    /**
     * Obtiene todos los registros
     */
    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    /**
     * Busca un registro por su clave primaria
     */
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Inserta un nuevo registro
     */
    public function create(array $data) {
        $fields = array_intersect_key($data, array_flip($this->fillable));
        $columns = implode(',', array_keys($fields));
        $placeholders = implode(',', array_fill(0, count($fields), '?'));
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        $stmt->execute(array_values($fields));
        return $this->find($this->pdo->lastInsertId());
    }

    /**
     * Actualiza un registro por su clave primaria
     */
    public function update($id, array $data) {
        $fields = array_intersect_key($data, array_flip($this->fillable));
        $set = implode(', ', array_map(fn($k) => "$k = ?", array_keys($fields)));
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET $set WHERE {$this->primaryKey} = ?");
        $stmt->execute([...array_values($fields), $id]);
        return $this->find($id);
    }

    /**
     * Elimina un registro por su clave primaria
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?");
        return $stmt->execute([$id]);
    }
}