<?php
// prestamos.php en el directorio pdo
require 'config.php';

function registrarPrestamo($usuario_id, $libro_id) {
    global $pdo;
    $pdo->beginTransaction();

    try {
        $stmt = $pdo->prepare("INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo) VALUES (?, ?, NOW())");
        $stmt->execute([$usuario_id, $libro_id]);

        $stmt = $pdo->prepare("UPDATE libros SET cantidad_disponible = cantidad_disponible - 1 WHERE id = ?");
        $stmt->execute([$libro_id]);

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}
?>
