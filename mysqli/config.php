<?php
$host = 'localhost';
$db = 'biblioteca';
$user = 'tu_usuario';
$pass = 'tu_contraseña';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
