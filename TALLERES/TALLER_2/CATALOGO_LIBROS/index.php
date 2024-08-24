<?php

include_once 'includes/header.php';
include_once 'includes/funciones.php';

$obptenerImfoLibros = obtenerLibros();

foreach ($obptenerImfoLibros as $detalle){
echo mostrarDetallesLibro($detalle);
//verificar si esta funcion esta haciendo lo propio
}

echo '<br>';

include_once 'includes/footer.php';
?>