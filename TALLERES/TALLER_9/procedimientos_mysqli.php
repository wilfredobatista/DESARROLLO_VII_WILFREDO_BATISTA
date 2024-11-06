<?php
require_once "config_mysqli.php";

// Función para registrar una venta
function registrarVenta($conn, $cliente_id, $producto_id, $cantidad)
{
    $query = "CALL sp_registrar_venta(?, ?, ?, @venta_id)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iii", $cliente_id, $producto_id, $cantidad);

    try {
        mysqli_stmt_execute($stmt);

        // Obtener el ID de la venta usando mysqli_stmt_get_result()
        $stmt = mysqli_prepare($conn, "SELECT @venta_id as venta_id");
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        echo "Venta registrada con éxito. ID de venta: " . $row['venta_id'];
    } catch (Exception $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    }

    mysqli_stmt_close($stmt);
}

// Función para obtener estadísticas de cliente
function obtenerEstadisticasCliente($conn, $cliente_id)
{
    $query = "CALL sp_estadisticas_cliente(?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cliente_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $estadisticas = mysqli_fetch_assoc($result);

        echo "<h3>Estadísticas del Cliente</h3>";
        echo "Nombre: " . $estadisticas['nombre'] . "<br>";
        echo "Membresía: " . $estadisticas['nivel_membresia'] . "<br>";
        echo "Total compras: " . $estadisticas['total_compras'] . "<br>";
        echo "Total gastado: $" . $estadisticas['total_gastado'] . "<br>";
        echo "Promedio de compra: $" . $estadisticas['promedio_compra'] . "<br>";
        echo "Últimos productos: " . $estadisticas['ultimos_productos'] . "<br>";
    }

    mysqli_stmt_close($stmt);
}

// Función para procesar la devolución
function procesarDevolucion($conn, $venta_id, $producto_id, $cantidad)
{

    try {
        $query = "CALL procesar_devolucion(?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "iii", $venta_id, $producto_id, $cantidad);

        // echo "<br><br>";
        // var_dump($stmt);
        // echo "<br><br>";


        if (mysqli_stmt_execute($stmt)) {
            echo "Devolución procesada correctamente.";
        }

        mysqli_stmt_close($stmt);
    } catch (mysqli_sql_exception $e) {
        // Manejar la excepción de MySQL
        echo "Error al procesar devolucion: " . $e->getMessage();
    }
}


function aplicarDescuento($conn, $cliente_id, $total_compra)
{
    try {
        // Llamar al procedimiento almacenado
        $stmt = $conn->prepare("CALL aplicar_descuento(?, ?, @descuento, @total_con_descuento)");
        $stmt->bind_param("ii", $cliente_id, $total_compra);
        $stmt->execute();

        // Obtener los valores de salida
        $result = $conn->query("SELECT @descuento, @total_con_descuento");
        $row = $result->fetch_assoc();
        $descuento = $row['@descuento'];
        $total_con_descuento = $row['@total_con_descuento'];

        // Retornar los resultados como un array
        return [
            'descuento' => $descuento,
            'total_con_descuento' => $total_con_descuento
        ];
    } catch (mysqli_sql_exception $e) {
        // Manejar el error
        echo "Error al aplicar el descuento: " . $e->getMessage();
        return null;
    }
}







function obtenerProductosBajoStock($conn, $umbralStock)
{
    try {
        // Preparar la consulta SQL
        $sql = "CALL obtener_productos_bajo_stock(?)";
        $stmt = $conn->prepare($sql);

        // Asignar el valor del parámetro
        $stmt->bind_param("i", $umbralStock);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();
        $productos = $result->fetch_all(MYSQLI_ASSOC);

        // Cerrar la sentencia
        $stmt->close();

        // Retornar los productos
        return $productos;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    } 
}




function calcularComisionVenta($conn, $id_venta) {
    try {
        // Preparar la llamada al procedimiento almacenado
        $sql = "CALL calcular_comision(?, @comision)";
        $stmt = $conn->prepare($sql);

        // Asignar el valor del parámetro de entrada
        $stmt->bind_param("i", $id_venta);

        // Ejecutar la llamada al procedimiento
        $stmt->execute();

        // Obtener el valor del parámetro de salida
        $stmt = $conn->prepare("SELECT @comision");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $comision = $row['@comision'];

        // Cerrar la sentencia
        $stmt->close();

        // Devolver la comisión
        return $comision;

    } catch (Exception $e) {
        echo "Error al calcular la comisión: " . $e->getMessage();
        return null;
    }
}













































// Ejemplos de uso
registrarVenta($conn, 1, 1, 2);
obtenerEstadisticasCliente($conn, 1);
// Ejemplo de uso de procesarDevolucion
echo "<br><br>";
procesarDevolucion($conn, 1, 1, 1);

echo "<br><br>";
// Datos del cliente y la compra
$cliente_id = 1;
$total_compra = 1500;
// Llamar a la función
$resultado = aplicarDescuento($conn, $cliente_id, $total_compra);
// Mostrar los resultados
if ($resultado) {
    echo "Id del cliente: " . $cliente_id . "<br>";
    echo "Descuento aplicado: " . $resultado['descuento'] * 100 . "%<br>";
    echo "Total con descuento: $" . $resultado['total_con_descuento'];
}





// Ejemplo de uso
$umbralStock = 10; // Define el umbral de stock
$productosBajoStock = obtenerProductosBajoStock($conn, $umbralStock);

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
$comision = calcularComisionVenta($conn, $id_venta);

// Mostrar la comisión calculada
if ($comision !== null) {
    echo "La comisión para la venta $id_venta es: $" . $comision;
}



mysqli_close($conn);
