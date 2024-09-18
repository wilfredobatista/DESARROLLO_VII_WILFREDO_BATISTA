<?php
// 1. Crear un arreglo multidimensional de ventas por región y producto
$ventas = [
    "Norte" => [
        "Producto A" => [100, 120, 140, 110, 130],
        "Producto B" => [85, 95, 105, 90, 100],
        "Producto C" => [60, 55, 65, 70, 75]
    ],
    "Sur" => [
        "Producto A" => [80, 90, 100, 85, 95],
        "Producto B" => [120, 110, 115, 125, 130],
        "Producto C" => [70, 75, 80, 65, 60]
    ],
    "Este" => [
        "Producto A" => [110, 115, 120, 105, 125],
        "Producto B" => [95, 100, 90, 105, 110],
        "Producto C" => [50, 60, 55, 65, 70]
    ],
    "Oeste" => [
        "Producto A" => [90, 85, 95, 100, 105],
        "Producto B" => [105, 110, 100, 115, 120],
        "Producto C" => [80, 85, 75, 70, 90]
    ]
];

// 2. Función para calcular el promedio de ventas
function promedioVentas($ventas) {
    return array_sum($ventas) / count($ventas);
}

// 3. Calcular y mostrar el promedio de ventas por región y producto
echo "Promedio de ventas por región y producto:\n<br>";
foreach ($ventas as $region => $productos) {
    echo "$region:\n<br>";
    foreach ($productos as $producto => $ventasProducto) {
        $promedio = promedioVentas($ventasProducto);
        echo "  $producto: " . number_format($promedio, 2) . "\n<br>";
    }
    echo "\n";
}

// 4. Función para encontrar el producto más vendido en una región
function productoMasVendido($productos) {
    $maxVentas = 0;
    $productoTop = '';
    foreach ($productos as $producto => $ventas) {
        $totalVentas = array_sum($ventas);
        if ($totalVentas > $maxVentas) {
            $maxVentas = $totalVentas;
            $productoTop = $producto;
        }
    }
    return [$productoTop, $maxVentas];
}

// 5. Encontrar y mostrar el producto más vendido por región
echo "<br><br>Producto más vendido por región:\n<br>";
foreach ($ventas as $region => $productos) {
    [$productoTop, $ventasTop] = productoMasVendido($productos);
    echo "$region:<br> $productoTop (Total: $ventasTop)\n<br>";
}

// 6. Calcular las ventas totales por producto
$ventasTotalesPorProducto = [];
foreach ($ventas as $region => $productos) {
    foreach ($productos as $producto => $ventasProducto) {
        if (!isset($ventasTotalesPorProducto[$producto])) {
            $ventasTotalesPorProducto[$producto] = 0;
        }
        $ventasTotalesPorProducto[$producto] += array_sum($ventasProducto);
    }
}

echo "<br><br>\nVentas totales por producto:\n<br>";
arsort($ventasTotalesPorProducto);
foreach ($ventasTotalesPorProducto as $producto => $total) {
    echo "$producto: $total\n<br>";
}

// 7. Encontrar la región con mayores ventas totales
$ventasTotalesPorRegion = array_map(function($productos) {
    return array_sum(array_map('array_sum', $productos));
}, $ventas);

$regionTopVentas = array_keys($ventasTotalesPorRegion, max($ventasTotalesPorRegion))[0];
echo "\nRegión con mayores ventas totales: $regionTopVentas\n";

// TAREA: Implementa una función que analice el crecimiento de ventas
// Calcula y muestra el porcentaje de crecimiento de ventas del primer al último mes
// para cada producto en cada región. Identifica el producto y la región con mayor crecimiento.
// Tu código aquí

// Función para calcular el porcentaje de crecimiento entre dos valores
function calcularCrecimiento($inicio, $fin) {
    return (($fin - $inicio) / $inicio) * 100;
}

// Función para calcular el crecimiento de ventas por producto en cada región
function crecimientoVentas($ventas) {
    $crecimientoPorProducto = [];
    foreach ($ventas as $region => $productos) {
        foreach ($productos as $producto => $ventasProducto) {
            $crecimiento = calcularCrecimiento($ventasProducto[0], end($ventasProducto));
            $crecimientoPorProducto[$region][$producto] = $crecimiento;
        }
    }
    return $crecimientoPorProducto;
}

// Calcular el crecimiento de ventas por región y producto
$crecimientoPorProducto = crecimientoVentas($ventas);

// Mostrar el crecimiento de ventas por región y producto
echo "<br><br>\nCrecimiento de ventas del primer al último mes:\n<br>";
foreach ($crecimientoPorProducto as $region => $productos) {
    echo "$region:\n<br>";
    foreach ($productos as $producto => $crecimiento) {
        echo "  $producto: " . number_format($crecimiento, 2) . "%\n<br>";
    }
}

// Identificar el producto y la región con mayor crecimiento
$maxCrecimiento = -INF;
$regionTop = '';
$productoTop = '';

foreach ($crecimientoPorProducto as $region => $productos) {
    foreach ($productos as $producto => $crecimiento) {
        if ($crecimiento > $maxCrecimiento) {
            $maxCrecimiento = $crecimiento;
            $regionTop = $region;
            $productoTop = $producto;
        }
    }
}

echo "<br>\nProducto con mayor crecimiento: <br>$productoTop en la región $regionTop con un crecimiento de " . number_format($maxCrecimiento, 2) . "%\n";



?>