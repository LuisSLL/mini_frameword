<?php
// Archivo de configuración global

// Configuración de entorno
const APP_ENV = 'development'; // Cambia a 'production' en producción
const BASE_URL = '/'; // Cambia si tu app está en un subdirectorio

// Configuración de base de datos
const DB_HOST = getenv('DB_HOST') ?: 'localhost';
const DB_NAME = getenv('DB_NAME') ?: 'miniframework';
const DB_USER = getenv('DB_USER') ?: 'root';
const DB_PASS = getenv('DB_PASS') ?: '';
const DB_CHARSET = 'utf8mb4';

// Puedes agregar más configuraciones según tu proyecto