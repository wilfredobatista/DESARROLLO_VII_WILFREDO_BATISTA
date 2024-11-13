<?php
// usuarios.php - Archivo principal de funciones para la gestión de usuarios

// Función para registrar un nuevo usuario
function registrarUsuario($nombre, $email, $password, $conn) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $hashedPassword);
    return $stmt->execute();
}

// Función para listar todos los usuarios
function listarUsuarios($conn, $limite, $offset) {
    $stmt = $conn->prepare("SELECT * FROM usuarios LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limite, $offset);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Función para buscar usuarios
function buscarUsuarios($query, $conn) {
    $likeQuery = "%$query%";
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre LIKE ? OR email LIKE ?");
    $stmt->bind_param("ss", $likeQuery, $likeQuery);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Función para actualizar información de un usuario
function actualizarUsuario($id, $nombre, $email, $password, $conn) {
    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nombre, $email, $hashedPassword, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nombre, $email, $id);
    }
    return $stmt->execute();
}

// Función para eliminar un usuario
function eliminarUsuario($id, $conn) {
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}