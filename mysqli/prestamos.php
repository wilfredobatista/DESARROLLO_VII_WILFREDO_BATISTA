<?php
// prestamos.php en el directorio mysqli
require 'config.php';

function registrarPrestamo($usuario_id, $libro_id) {
    global $mysqli;
    $mysqli->begin_transaction();

    try {
        $stmt = $mysqli->prepare("INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo) VALUES (?, ?, NOW())");
        $stmt->bind_param('ii', $usuario_id, $libro_id);
        $stmt->execute();
        $stmt->close();

        $stmt = $mysqli->prepare("UPDATE libros SET cantidad_disponible = cantidad_disponible - 1 WHERE id = ?");
        $stmt->bind_param('i', $libro_id);
        $stmt->execute();
        $stmt->close();

        $mysqli->commit();
    } catch (Exception $e) {
        $mysqli->rollback();
        throw $e;
    }
}
?>
