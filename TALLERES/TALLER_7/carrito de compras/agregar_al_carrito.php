<?php
include 'config_sesion.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id !== null && $id !== false) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = 0;
    }
    $_SESSION['carrito'][$id]++;
}

header('Location: ver_carrito.php');
exit;
?>