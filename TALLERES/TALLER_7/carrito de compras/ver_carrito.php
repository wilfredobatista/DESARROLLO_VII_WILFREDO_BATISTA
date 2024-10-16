<?php
include 'config_sesion.php';
$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10.00],
    2 => ['nombre' => 'Producto 2', 'precio' => 15.00],
    3 => ['nombre' => 'Producto 3', 'precio' => 20.00],
    4 => ['nombre' => 'Producto 4', 'precio' => 25.00],
    5 => ['nombre' => 'Producto 5', 'precio' => 30.00]
];

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <?php if (!empty($_SESSION['carrito'])): ?>
        <ul>
            <?php foreach ($_SESSION['carrito'] as $id => $cantidad): 
                $producto = $productos[$id];
                $subtotal = $producto['precio'] * $cantidad;
                $total += $subtotal;
            ?>
                <li>
                    <?php echo htmlspecialchars($producto['nombre']); ?> - 
                    Cantidad: <?php echo $cantidad; ?> - 
                    Subtotal: $<?php echo number_format($subtotal, 2); ?>
                    <a href="eliminar_del_carrito.php?id=<?php echo $id; ?>">Eliminar</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p>Total: $<?php echo number_format($total, 2); ?></p>
        <a href="checkout.php">Proceder al Checkout</a>
    <?php else: ?>
        <p>El carrito está vacío.</p>
    <?php endif; ?>
    <a href="productos.php">Volver a la lista de productos</a>
</body>
</html>