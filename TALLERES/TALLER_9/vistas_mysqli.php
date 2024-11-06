<?php
require_once "config_mysqli.php";

function mostrarResumenCategorias($conn) {
    $sql = "SELECT * FROM vista_resumen_categorias";
    $result = mysqli_query($conn, $sql);

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
    while ($row = mysqli_fetch_assoc($result)) {
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
    mysqli_free_result($result);
}



function mostrarProductosPopulares($conn) {
    $sql = "SELECT * FROM vista_productos_populares LIMIT 5";
    $result = mysqli_query($conn, $sql);

    echo "<h3>Top 5 Productos Más Vendidos:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Total Vendido</th>
            <th>Ingresos Totales</th>
            <th>Compradores Únicos</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['producto']}</td>";
        echo "<td>{$row['categoria']}</td>";
        echo "<td>{$row['total_vendido']}</td>";
        echo "<td>{$row['ingresos_totales']}</td>";
        echo "<td>{$row['compradores_unicos']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}





function mostrarProductosBajoStock($conn) {
    $sql = "SELECT * FROM productos_bajo_stock_ventas";
    $result = mysqli_query($conn, $sql);
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
    while ($row = mysqli_fetch_assoc($result)) {
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
    mysqli_free_result($result);
}







function mostrarHistorialClientes($conn) {
    $sql = "SELECT * FROM historial_clientes";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conn));
    }

    echo "<h3>Historial de Clientes:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Productos Comprados</th>
            <th>Monto Total Gastado</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['cliente_id']}</td>";
        echo "<td>{$row['nombre_cliente']}</td>";
        echo "<td>{$row['email_cliente']}</td>";
        echo "<td>{$row['productos_comprados']}</td>";
        echo "<td>\${$row['monto_total_gastado']}</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_free_result($result);
}













function mostrarResumenVentas($conn) {
    $sql = "SELECT * FROM resumen_ventas";
    $result = mysqli_query($conn, $sql);

    echo "<h3>Resumen de Ventas por Producto:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Producto</th>
            <th>Total Ventas</th>
            <th>Cantidad de Productos</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['producto']}</td>";
        echo "<td>{$row['total_ventas']}</td>";
        echo "<td>{$row['cantidad_productos']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}






















// Mostrar los resultados
mostrarResumenCategorias($conn);
mostrarProductosPopulares($conn);
mostrarProductosBajoStock($conn);
mostrarHistorialClientes($conn);
mostrarResumenVentas($conn);
mysqli_close($conn);