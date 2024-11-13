<?php
// libros.php en el directorio pdo
require 'config.php';

function añadirLibro($titulo, $autor, $isbn, $año, $cantidad) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO libros (titulo, autor, isbn, año_publicacion, cantidad_disponible) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$titulo, $autor, $isbn, $año, $cantidad]);
}
?>
