<<?php

// 1. Calcular el descuento total de la tienda
function calcular_descuento($total_compras) {
    $descuento = 0;

    if ($total_compras <= 100) {
        $descuento = 0;
    } elseif ($total_compras >= 101 && $total_compras <= 500) {
        $descuento = $total_compras * 0.05;
    } elseif ($total_compras >= 501 && $total_compras <= 1000) {
        $descuento = $total_compras * 0.1;
    } elseif ($total_compras > 1000) {
        $descuento = $total_compras * 0.15;
    }

    return $descuento;
}

// 2. Aplicar el impuesto
function aplicar_impuesto($subtotal) {
    $impuesto = $subtotal * 0.07; // El 7% de impuesto, corregido del 0.7 al 0.07
    return $impuesto;
}

// 3. Calcular el total a pagar
function calcular_total($subtotal, $descuento, $impuesto) {
    $total_a_pagar = $subtotal - $descuento + $impuesto;
    return $total_a_pagar;
}

?>