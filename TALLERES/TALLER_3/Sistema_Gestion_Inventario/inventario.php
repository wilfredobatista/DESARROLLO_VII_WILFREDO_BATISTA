<?php
$json_productos = file_get_contents('inventario.json' );//leemos el json

$json_productos = json_decode($json_productos,true);//comvertimos el json a array

sort ($json_productos);//array ordenado

echo "LISTA DE PRODUCTOS ORDENADOS <br> <br>";
foreach ($json_productos as $key => $value) {
    echo "Producto ". $key+1 . "<br>"  ;
    echo " Nombre: ". $value["nombre"]."<br>Precio: ". $value["precio"]. "<br>cantidad: ".$value["cantidad"];
    echo "<br> <br>";
}

echo "VALOR TOTAL DEL INVENTARIO:<br>";
$valor_total = array_sum(array_map(function($producto){
    return $producto['precio']* $producto['cantidad'];
}, $json_productos));
print_r ($valor_total);

echo "<br><br> LISTADO DEL STOCK BAJO:<br>";
$stock_bajo = array_filter($json_productos,function ($cantidad){
return $cantidad['cantidad'] < 5;
});

foreach ($stock_bajo as $key =>$value) {
    echo "Producto ". $key+1 . "<br>"  ;
    echo " Nombre: ". $value["nombre"]."<br>Precio: ". $value["precio"]. "<br>cantidad: ".$value["cantidad"];
    echo "<br> <br>";
}
?>