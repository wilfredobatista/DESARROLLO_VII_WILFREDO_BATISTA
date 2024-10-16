<?php
include 'config_sesion.php';
$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10.00],
    2 => ['nombre' => 'Producto 2', 'precio' => 15.00],
    3 => ['nombre' => 'Producto 3', 'precio' => 20.00],
    4 => ['nombre' => 'Producto 4', 'precio' => 25.00],
    5 => ['nombre' => 'Producto 5', 'precio' => 30.00]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Productos Disponibles</h1>
    <ul>
        <?php foreach ($productos as $id => $producto): ?>
            <li>
                <?php echo htmlspecialchars($producto['nombre']); ?> - 
                $<?php echo number_format($producto['precio'], 2); ?>
                <a href="agregar_al_carrito.php?id=<?php echo $id; ?>">Añadir al carrito</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>