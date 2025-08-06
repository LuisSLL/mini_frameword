<?php
namespace Core;

/**
 * View: helper para cargar vistas frontend y backend
 */
class View {
    /**
     * Renderiza una vista
     * @param string $view Ruta relativa dentro de /app/Views (ej: 'frontend/home')
     * @param array $data Variables para la vista
     */
    public static function render(string $view, array $data = []) {
        extract($data);
        $file = __DIR__ . '/../app/Views/' . $view . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            echo "Vista no encontrada: $view";
        }
    }
}