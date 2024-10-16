<?php
session_start([
    'cookie_lifetime' => 86400, // 1 día
    'cookie_secure' => true,    // Solo si usas HTTPS
    'cookie_httponly' => true,  // Prevenir acceso a la cookie por JavaScript
    'use_strict_mode' => true,  // Evitar secuestro de sesión
    'use_cookies' => true,
    'use_only_cookies' => true,
    'cookie_samesite' => 'Strict' // Limita el acceso a la cookie
]);
?>