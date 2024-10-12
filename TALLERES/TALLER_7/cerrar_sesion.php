<?php
session_start();
require_once 'config_sesion.php';
// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

echo "Has cerrado sesión.";
?>