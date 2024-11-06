
<?php
require_once "config_mysqli.php";

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

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: {$row['promedio_categoria']}<br>";
    }
    mysqli_free_result($result);
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
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Cliente: {$row['nombre']}, Total compras: {$row['total_compras']}, ";
        echo "Promedio general: {$row['promedio_ventas']}<br>";
    }
    mysqli_free_result($result);
}

// 3. Productos que nunca se han vendido
$sql = "SELECT nombre 
        FROM productos 
        WHERE id NOT IN (SELECT DISTINCT producto_id FROM detalles_venta)";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos que nunca se han vendido:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Nombre: {$row['nombre']}<br>";
    }
    mysqli_free_result($result);
}


//lista de las categorias con el numeor de productos y el valor total del inventario


$sql = "SELECT c.nombre AS categoria, 
        COUNT(p.id) AS numero_productos, 
        SUM(p.precio * p.stock) AS valor_total_inventario
        FROM 
            categorias c
        LEFT JOIN
            productos p ON c.id = p.categoria_id
        GROUP BY c.nombre";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Lista de categorias con el numero de productos y el valor total del inventario:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        // Accede a los nombres de columna correctos
        echo "Categoría: {$row['categoria']}, "; 
        echo "Número de productos: {$row['numero_productos']}, ";
        echo "Valor total del inventario: {$row['valor_total_inventario']}<br>"; 
    }
    mysqli_free_result($result);
}


$sql = "SELECT c.nombre as cliente
        FROM clientes c
        JOIN ventas v ON c.id = v.cliente_id
        JOIN detalles_venta dv ON v.id = dv.venta_id
        WHERE dv.producto_id IN (SELECT id FROM productos WHERE categoria_id = 1)
        GROUP BY c.nombre
        HAVING COUNT(DISTINCT dv.producto_id) = (SELECT COUNT(*) FROM productos WHERE categoria_id = 1)";

$result = mysqli_query($conn, $sql);

if ($result){
    echo "<H3> Clientes que han comprado todos los productos de una categoria</H3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Cliente: {$row['cliente']}<br>"; 
    }
    mysqli_free_result($result);
}



$categoria_id = 4; // Reemplaza con el ID de la categoría deseada
$sql = "SELECT c.nombre AS cliente
        FROM clientes c
        JOIN ventas v ON c.id = v.cliente_id
        JOIN detalles_venta dv ON v.id = dv.venta_id
        WHERE dv.producto_id IN (SELECT id FROM productos WHERE categoria_id = $categoria_id) -- Reemplaza '1' con el ID de la categoría deseada
        GROUP BY c.nombre
        HAVING COUNT(DISTINCT dv.producto_id) = (SELECT COUNT(*) FROM productos WHERE categoria_id = $categoria_id)"; //-- Reemplaza '1' con el ID de la categoría deseada;

$result = mysqli_query($conn, $sql);

if ($result){
    echo "<H3> Porcetaje de ventas de cada producto respecto al total de ventas</H3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Cliente: {$row['cliente']}<br>"; 
    }
    mysqli_free_result($result);
}



mysqli_close($conn);
?>