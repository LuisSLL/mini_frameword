<?php
// Definición de rutas web (frontend y backend)
// $this se refiere al Router

// Ruta de inicio (frontend)
$this->get('/', 'HomeController@index');

// Ruta de panel de administrador (backend)
$this->get('/admin', 'AdminController@index');