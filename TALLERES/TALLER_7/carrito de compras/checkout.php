<?php
include 'config_sesion.php';
if (!empty($_SESSION['carrito'])) {
    $nombreUsuario = filter_input(INPUT_POST, 'nombre_usuario', FILTER_DEFAULT);
    $nombreUsuario = htmlspecialchars($nombreUsuario ?? '', ENT_QUOTES, 'UTF-8');
    
    if (!empty($nombreUsuario)) {
        setcookie('nombre_usuario', $nombreUsuario, time() + 86400, "/", "", true, true);
    }

    $_SESSION['carrito'] = [];
    $mensaje = "Compra realizada exitosamente por $nombreUsuario.";
} else {
    $mensaje = "El carrito está vacío.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></h1>
    <a href="productos.php">Volver a la lista de productos</a>
</body>
</html>