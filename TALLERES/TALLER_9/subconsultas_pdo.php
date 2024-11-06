<?php
require_once "config_pdo.php";

try {
    // 1. Productos que tienen un precio mayor al promedio de su categoría
    $sql = "SELECT p.nombre, p.precio, c.nombre as categoria,
            (SELECT AVG(precio) FROM productos WHERE categoria_id = p.categoria_id) as promedio_categoria
            FROM productos p
            JOIN categorias c ON p.categoria_id = c.id
            WHERE p.precio > (
                SELECT AVG(precio)
                FROM productos p2
                WHERE p2.categoria_id = p.categoria_id
            )";

    $stmt = $pdo->query($sql);

    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: {$row['promedio_categoria']}<br>";
    }

    // 2. Clientes con compras superiores al promedio
    $sql = "SELECT c.nombre, c.email,
            (SELECT SUM(total) FROM ventas WHERE cliente_id = c.id) as total_compras,
            (SELECT AVG(total) FROM ventas) as promedio_ventas
            FROM clientes c
            WHERE (
                SELECT SUM(total)
                FROM ventas
                WHERE cliente_id = c.id
            ) > (
                SELECT AVG(total)
                FROM ventas
            )";

    $stmt = $pdo->query($sql);

    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['nombre']}, Total compras: {$row['total_compras']}, ";
        echo "Promedio general: {$row['promedio_ventas']}<br>";
    }




$sql = "SELECT c.nombre AS categoria, 
            COUNT(p.id) AS numero_productos, 
            SUM(p.precio * p.stock) AS valor_total_inventario
        FROM 
            categorias c
        LEFT JOIN
            productos p ON c.id = p.categoria_id
        GROUP BY c.nombre";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo "<h3>Lista de categorias con el numero de productos y el valor total del inventario:</h3>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Categoría: {$row['categoria']}, ";
    echo "Número de productos: {$row['numero_productos']}, ";
    echo "Valor total del inventario: {$row['valor_total_inventario']}<br>";
};




$sql_categorias = "SELECT id, nombre FROM categorias";
$stmt_categorias = $pdo->query($sql_categorias);
$categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

// Iterar sobre cada categoría
foreach ($categorias as $categoria) {
    $categoria_id = $categoria['id'];

    $sql = "SELECT c.nombre AS cliente
            FROM clientes c
            JOIN ventas v ON c.id = v.cliente_id
            JOIN detalles_venta dv ON v.id = dv.venta_id
            WHERE dv.producto_id IN (SELECT id FROM productos WHERE categoria_id = :categoria_id)
            GROUP BY c.nombre
            HAVING COUNT(DISTINCT dv.producto_id) = (SELECT COUNT(*) FROM productos WHERE categoria_id = :categoria_id)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
    $stmt->execute();

    echo "<h3>Categoría: " . $categoria['nombre'] . "</h3>";
    
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Cliente: " . $row['cliente'] . "<br>";
        }
    } else {
        echo "No hay clientes que hayan comprado todos los productos de esta categoría.<br>";
    }
}

$categoria_id = 4; // Reemplaza con el ID de la categoría deseada
$sql = "SELECT c.nombre AS cliente
FROM clientes c
JOIN ventas v ON c.id = v.cliente_id
JOIN detalles_venta dv ON v.id = dv.venta_id
WHERE dv.producto_id IN (SELECT id FROM productos WHERE categoria_id = :categoria_id)
GROUP BY c.nombre
HAVING COUNT(DISTINCT dv.producto_id) = (SELECT COUNT(*) FROM productos WHERE categoria_id = :categoria_id)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
$stmt->execute();

echo "<H3> Clientes que han comprado todos los productos de una categoria</H3>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo "Cliente: {$row['cliente']}<br>"; 
}

















} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}



$pdo = null;
?>