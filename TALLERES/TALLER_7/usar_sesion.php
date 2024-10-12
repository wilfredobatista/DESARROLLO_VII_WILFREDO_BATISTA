<?php
session_start();
require_once 'config_sesion.php';
if(isset($_SESSION['usuario'])) {
    echo "Bienvenido/a, " . htmlspecialchars($_SESSION['usuario']) . "!<br>";
    echo "Tu rol es: " . htmlspecialchars($_SESSION['rol']);
} else {
    echo "No has iniciado sesión.";
}
?>