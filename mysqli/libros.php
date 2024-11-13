<?php
// libros.php en el directorio mysqli
require 'config.php';

function añadirLibro($titulo, $autor, $isbn, $año, $cantidad) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO libros (titulo, autor, isbn, año_publicacion, cantidad_disponible) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssii', $titulo, $autor, $isbn, $año, $cantidad);
    $stmt->execute();
    $stmt->close();
}
?>
