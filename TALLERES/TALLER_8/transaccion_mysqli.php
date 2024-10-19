<?php

require_once "config_mysqli.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Habilitar reporte de errores de MySQLi

try {
    mysqli_begin_transaction($conn);

    // Insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la sentencia: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "ss", $nombre, $email);
    $nombre = "Nuevo Usuario";
    $email = "nuevo@example.com";
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error al ejecutar la sentencia: " . mysqli_stmt_error($stmt));
    }
    $usuario_id = mysqli_insert_id($conn);

    // Insertar una publicación para ese usuario
    $sql = "INSERT INTO publicaciones (usuario_id, titulo, contenido) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la sentencia: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "iss", $usuario_id, $titulo, $contenido);
    $titulo = "Nueva Publicación";
    $contenido = "Contenido de la nueva publicación";
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error al ejecutar la sentencia: " . mysqli_stmt_error($stmt));
    }

    mysqli_commit($conn);
    echo "Transacción completada con éxito.";
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error en la transacción: " . $e->getMessage();
} finally {
    if (isset($stmt) && $stmt) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>
        