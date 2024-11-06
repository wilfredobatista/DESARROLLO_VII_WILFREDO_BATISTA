<?php
require_once "config_pdo.php";

function mostrarResumenCategorias($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM vista_resumen_categorias");

        echo "<h3>Resumen por Categorías:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Categoría</th>
                <th>Total Productos</th>
                <th>Stock Total</th>
                <th>Precio Promedio</th>
                <th>Precio Mínimo</th>
                <th>Precio Máximo</th>
              </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['categoria']}</td>";
            echo "<td>{$row['total_productos']}</td>";
            echo "<td>{$row['total_stock']}</td>";
            echo "<td>{$row['precio_promedio']}</td>";
            echo "<td>{$row['precio_minimo']}</td>";
            echo "<td>{$row['precio_maximo']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function mostrarProductosPopulares($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM vista_productos_populares LIMIT 5");

        echo "<h3>Top 5 Productos Más Vendidos:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Total Vendido</th>
                <th>Ingresos Totales</th>
                <th>Compradores Únicos</th>
              </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['producto']}</td>";
            echo "<td>{$row['categoria']}</td>";
            echo "<td>{$row['total_vendido']}</td>";
            echo "<td>{$row['ingresos_totales']}</td>";
            echo "<td>{$row['compradores_unicos']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}









function mostrarProductosBajoStock($conn) {
    try {
        $sql = "SELECT * FROM productos_bajo_stock_ventas";
        $stmt = $conn->query($sql);

        echo "<h3>Productos con Bajo Stock y sus Ventas:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>ID Producto</th>
                <th>Nombre Producto</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>ID Venta</th>
                <th>Fecha Venta</th>
                <th>Cantidad Vendida</th>
                <th>Precio Unitario</th>
              </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['producto_id']}</td>";
            echo "<td>{$row['nombre_producto']}</td>";
            echo "<td>{$row['stock']}</td>";
            echo "<td>{$row['categoria']}</td>";
            echo "<td>{$row['venta_id']}</td>";
            echo "<td>{$row['fecha_venta']}</td>";
            echo "<td>{$row['cantidad_vendida']}</td>";
            echo "<td>{$row['precio_unitario']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error al mostrar productos con bajo stock: " . $e->getMessage();
    }
}

function mostrarHistorialClientes($conn) {
    try {
        $sql = "SELECT * FROM historial_clientes";
        $stmt = $conn->query($sql);

        echo "<h3>Historial de Clientes:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Productos Comprados</th>
                <th>Monto Total Gastado</th>
              </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['cliente_id']}</td>";
            echo "<td>{$row['nombre_cliente']}</td>";
            echo "<td>{$row['email_cliente']}</td>";
            echo "<td>{$row['productos_comprados']}</td>";
            echo "<td>\${$row['monto_total_gastado']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error al mostrar el historial de clientes: " . $e->getMessage();
    }
}












function mostrarResumenVentas($conn) {
    try {
        $sql = "SELECT * FROM resumen_ventas";
        $stmt = $conn->query($sql);

        echo "<h3>Resumen de Ventas por Producto:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Producto</th>
                <th>Total Ventas</th>
                <th>Cantidad de Productos</th>
              </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['producto']}</td>";
            echo "<td>{$row['total_ventas']}</td>";
            echo "<td>{$row['cantidad_productos']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error al obtener el resumen de ventas: " . $e->getMessage();
    }
}




















// Mostrar los resultados
mostrarResumenCategorias($pdo);
mostrarProductosPopulares($pdo);
mostrarProductosBajoStock($pdo);
mostrarHistorialClientes($pdo);
mostrarResumenVentas($pdo);

$pdo = null;
?>