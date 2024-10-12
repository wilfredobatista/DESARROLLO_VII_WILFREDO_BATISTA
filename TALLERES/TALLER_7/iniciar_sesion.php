<?php
session_start();
require_once 'config_sesion.php';

$_SESSION['usuario'] = "María";
$_SESSION['rol'] = "admin";

echo "Sesión iniciada para " . $_SESSION['usuario'];
?>