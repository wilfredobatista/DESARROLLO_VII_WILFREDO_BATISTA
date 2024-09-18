<?php
// 1. Crear un arreglo asociativo de productos con su inventario
$inventario = [
    "laptop" => ["cantidad" => 50, "precio" => 800],
    "smartphone" => ["cantidad" => 100, "precio" => 500],
    "tablet" => ["cantidad" => 30, "precio" => 300],
    "smartwatch" => ["cantidad" => 25, "precio" => 150]
];

// 2. Función para mostrar el inventario
function mostrarInventario($inventario)
{
    foreach ($inventario as $producto => $info) {
        echo "$producto: {$info['cantidad']} unidades, Precio: $ {$info['precio']}\n<br>";
    }
    echo "<br>";
}

// 3. Mostrar inventario inicial
echo "Inventario inicial:<br>\n";
mostrarInventario($inventario); //esta linea imprime

// 4. Función para actualizar el inventario
function actualizarInventario(&$inv, $producto, $cantidad, $precio = null)
{
    if (!isset($inv[$producto])) {
        $inv[$producto] = ["cantidad" => $cantidad, "precio" => $precio];
    } else {
        $inv[$producto]["cantidad"] += $cantidad;
        if ($precio !== null) {
            $inv[$producto]["precio"] = $precio;
        }
    }
}

// 5. Actualizar inventario
actualizarInventario($inventario, "laptop", -5);  // Venta de 5 laptops
actualizarInventario($inventario, "smartphone", 50, 450);  // Nuevo lote de smartphones con precio actualizado
actualizarInventario($inventario, "auriculares", 100, 50);  // Nuevo producto
actualizarInventario($inventario, "auriculares", 100, 50);  // Nuevo producto

// 6. Mostrar inventario actualizado
echo "\nInventario actualizado:\n<br>";
mostrarInventario($inventario);

// 7. Función para calcular el valor total del inventario
function valorTotalInventario($inventario)
{
    $total = 0;
    foreach ($inventario as $producto => $info) {
        $total += ($info['cantidad'] * $info['precio']);
    }
    return $total;
}

// 8. Mostrar valor total del inventario
echo "\nValor total del inventario: $" . valorTotalInventario($inventario) . "\n";

// TAREA: Crea una función que encuentre y retorne el producto con el mayor valor total en inventario
// (cantidad * precio). Muestra el resultado.
// Tu código aquí
echo "<br><br>";

//funcion que encuentra el producto con el mayor valor del inventario cantidad * precio
function producto_Mayor_valor($inventario)
{
    $total = 0;
    $indice_temp = 0;
    $mayor_valor_producto = [];
    $mayor_valor_cantidad = [];
    //separo producto/informacion
    foreach ($inventario as $producto => $informacion) {
        # code...
        $total = $total + ($informacion['cantidad'] * $informacion['precio']);
        array_push($mayor_valor_producto, $producto);
        array_push($mayor_valor_cantidad, $total);
        // array_push($mayor_valor, $producto[$informacion]);
        // echo "<br> dentro del foreach el valor de este producto es: $total";
        $total = 0;
    }
    //ubica el mayor de todos
    $total = $mayor_valor_cantidad[0];
    for ($i = 0; $i < count($mayor_valor_cantidad); $i++) {
        if ($total >= $mayor_valor_cantidad[$i]) {
            // echo "no deberia pasar nada ";# code...
        } else {
            $total = $mayor_valor_cantidad[$i];
            $indice_temp = $i;
        }
    }
    //devuelo el monto mas alto con el indicie del producto, 
    return "<br> el producto de mayor valor es: " . $mayor_valor_producto[$indice_temp] . " con un total de: " . $total . " $";
}
$may_val = producto_Mayor_valor($inventario);
echo $may_val;
