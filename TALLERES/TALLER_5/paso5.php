<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electrónica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electrónica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electrónica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electrónica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electrónica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana López", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gómez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "María Rodríguez", "email": "maria@example.com"}
    ]
}
';

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos) {
    foreach ($productos as $producto) {
        echo "{$producto['nombre']} - \${$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "\n<br>";
    }
}

echo "Productos de {$tiendaData['tienda']}:\n<br>";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "<br>\nValor total del inventario: \$$valorTotal\n <br>";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);

echo "\nProducto más caro: {$productoMasCaro['nombre']} (\${$productoMasCaro['precio']})\n<br>";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, function($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "\nProductos en la categoría 'computadoras':\n<br>";
imprimirProductos($productosDeComputadoras);

// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electrónica", "accesorios", "wearables"]
];
$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT);
// echo "<br><br>\nDatos actualizados de la tienda (JSON):\n$jsonActualizado\n";

// 9. Función que genera un resumen de ventas
function generarResumenVentas($ventas, $productos, $clientes) {
    $totalVentas = 0;
    $cantidadProductosVendidos = [];
    $ventasPorCliente = [];

    // Inicializar conteos
    foreach ($productos as $producto) {
        $cantidadProductosVendidos[$producto['id']] = 0;
    }
    foreach ($clientes as $cliente) {
        $ventasPorCliente[$cliente['id']] = 0;
    }

    // Procesar ventas
    foreach ($ventas as $venta) {
        $productoId = $venta['producto_id'];
        $clienteId = $venta['cliente_id'];
        $cantidad = $venta['cantidad'];

        $totalVentas += $productos[$productoId - 1]['precio'] * $cantidad;
        $cantidadProductosVendidos[$productoId] += $cantidad;
        $ventasPorCliente[$clienteId] += $cantidad;
    }

    // Encontrar el producto más vendido
    $productoMasVendidoId = array_search(max($cantidadProductosVendidos), $cantidadProductosVendidos);
    $productoMasVendido = array_values(array_filter($productos, function($producto) use ($productoMasVendidoId) {
        return $producto['id'] == $productoMasVendidoId;
    }))[0];

    // Encontrar el cliente que más ha comprado
    $clienteMasCompradorId = array_search(max($ventasPorCliente), $ventasPorCliente);
    $clienteMasComprador = array_values(array_filter($clientes, function($cliente) use ($clienteMasCompradorId) {
        return $cliente['id'] == $clienteMasCompradorId;
    }))[0];

    // Generar el resumen en formato legible
    $resumen = "<br><br>Resumen de Ventas:\n<br>";
    $resumen .= "Total de ventas: \$$totalVentas\n<br>";
    $resumen .= "Producto más vendido: {$productoMasVendido['nombre']} (ID: {$productoMasVendido['id']})\n<br>";
    $resumen .= "Cliente que más ha comprado: {$clienteMasComprador['nombre']} (ID: {$clienteMasComprador['id']})\n";

    return $resumen;
}

// Crear un arreglo de ventas para probar la función
$ventas = [
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 2, "fecha" => "2024-09-01"],
    ["producto_id" => 2, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2024-09-02"],
    ["producto_id" => 3, "cliente_id" => 101, "cantidad" => 1, "fecha" => "2024-09-03"],
    ["producto_id" => 1, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2024-09-04"],
    ["producto_id" => 4, "cliente_id" => 102, "cantidad" => 2, "fecha" => "2024-09-05"],
    ["producto_id" => 5, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2024-09-06"],
    ["producto_id" => 6, "cliente_id" => 101, "cantidad" => 1, "fecha" => "2024-09-07"]
];

// Ejemplo de uso de la función de resumen de ventas
echo "\n\n" . generarResumenVentas($ventas, $tiendaData['productos'], $tiendaData['clientes']);
?>