<?php
namespace Core;

/**
 * Database: gestiona la conexión PDO a la base de datos
 */
class Database {
    private static $pdo = null;

    /**
     * Obtiene la instancia PDO (singleton)
     */
    public static function getInstance() {
        if (self::$pdo === null) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            self::$pdo = new \PDO($dsn, DB_USER, DB_PASS, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
        }
        return self::$pdo;
    }
}