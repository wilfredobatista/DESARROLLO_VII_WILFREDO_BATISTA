<?php
require_once "config_pdo.php";

// Función para registrar una venta
function registrarVenta($pdo, $cliente_id, $producto_id, $cantidad)
{
    try {
        $stmt = $pdo->prepare("CALL sp_registrar_venta(:cliente_id, :producto_id, :cantidad, @venta_id)");
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el ID de la venta
        $result = $pdo->query("SELECT @venta_id as venta_id")->fetch(PDO::FETCH_ASSOC);

        echo "Venta registrada con éxito. ID de venta: " . $result['venta_id'];
    } catch (PDOException $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    }
}

// Función para obtener estadísticas de cliente
function obtenerEstadisticasCliente($pdo, $cliente_id)
{
    try {
        $stmt = $pdo->prepare("CALL sp_estadisticas_cliente(:cliente_id)");
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->execute();

        $estadisticas = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<h3>Estadísticas del Cliente</h3>";
        echo "Nombre: " . $estadisticas['nombre'] . "<br>";
        echo "Membresía: " . $estadisticas['nivel_membresia'] . "<br>";
        echo "Total compras: " . $estadisticas['total_compras'] . "<br>";
        echo "Total gastado: $" . $estadisticas['total_gastado'] . "<br>";
        echo "Promedio de compra: $" . $estadisticas['promedio_compra'] . "<br>";
        echo "Últimos productos: " . $estadisticas['ultimos_productos'] . "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



// Función para procesar la devolución con PDO
function procesarDevolucion($pdo, $venta_id, $producto_id, $cantidad)
{
    try {
        $query = "CALL procesar_devolucion(?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $venta_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(3, $cantidad, PDO::PARAM_INT);
        $stmt->execute();

        echo "Devolución procesada correctamente.";
    } catch (PDOException $e) {
        echo "Error al procesar la devolución: " . $e->getMessage();
    }
}





function aplicarDescuento($pdo, $cliente_id, $total_compra)
{
    try {
        // Llamar al procedimiento almacenado
        $stmt = $pdo->prepare("CALL aplicar_descuento(?, ?, @descuento, @total_con_descuento)");
        $stmt->bindParam(1, $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $total_compra, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener los valores de salida
        $stmt = $pdo->query("SELECT @descuento, @total_con_descuento");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $descuento = $result['@descuento'];
        $total_con_descuento = $result['@total_con_descuento'];

        // Retornar los resultados como un array
        return [
            'descuento' => $descuento,
            'total_con_descuento' => $total_con_descuento
        ];
    } catch (PDOException $e) {
        // Manejar el error
        echo "Error al aplicar el descuento: " . $e->getMessage();
        return null;
    }
}














// Función para obtener productos con bajo stock
function obtenerProductosBajoStock($pdo, $umbralStock)
{
    try {
        // Preparar la consulta SQL
        $sql = "CALL obtener_productos_bajo_stock(?)";
        $stmt = $pdo->prepare($sql);

        // Asignar el valor del parámetro
        $stmt->bindParam(1, $umbralStock, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retornar los productos
        return $productos;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    } 
}





function calcularComisionVenta($conn, $id_venta) {
    try {
        // Llamar al procedimiento almacenado
        $stmt = $conn->prepare("CALL calcular_comision(:id_venta, @comision)");
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el valor del parámetro de salida
        $stmt = $conn->query("SELECT @comision");
        $comision = $stmt->fetchColumn();

        // Devolver la comisión
        return $comision;

    } catch (PDOException $e) {
        echo "Error al calcular la comisión: " . $e->getMessage();
        return null;
    }
}




















// Ejemplos de uso
registrarVenta($pdo, 1, 1, 2);
obtenerEstadisticasCliente($pdo, 1);
echo "<br><br>";
procesarDevolucion($pdo, 1, 1, 1);
echo "<br><br>";


// Datos del cliente y la compra
$cliente_id = 1;
$total_compra = 1500;

// Llamar a la función
$resultado = aplicarDescuento($pdo, $cliente_id, $total_compra);
// Mostrar los resultados
if ($resultado) {
    echo "Id del cliente: " . $cliente_id . "<br>";
    echo "Descuento aplicado: " . $resultado['descuento'] * 100 . "%<br>";
    echo "Total con descuento: $" . $resultado['total_con_descuento'];
}




obtenerProductosBajoStock($pdo,10);

// Ejemplo de uso
$umbralStock = 10; // Define el umbral de stock
$productosBajoStock = obtenerProductosBajoStock($pdo, $umbralStock);

// Mostrar los resultados
if ($productosBajoStock) {
    echo "<h2>Reporte de productos con bajo stock:</h2>";
    echo "<ul>";
    foreach ($productosBajoStock as $producto) {
        echo "<li>";
        echo "Nombre: " . $producto['NombreProducto'] . "<br>";
        echo "Stock: " . $producto['StockActual'] . "<br>";
        echo "Categoría: " . $producto['Categoría'] . "<br>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No se encontraron productos con bajo stock.";
}



// ID de la venta para la que quieres calcular la comisión
$id_venta = 1; // Reemplaza con el ID de la venta que te interese

// Llamar a la función para calcular la comisión
$comision = calcularComisionVenta($pdo, $id_venta);

// Mostrar la comisión calculada
if ($comision !== null) {
    echo "La comisión para la venta $id_venta es: $" . $comision;
}









$pdo = null;
