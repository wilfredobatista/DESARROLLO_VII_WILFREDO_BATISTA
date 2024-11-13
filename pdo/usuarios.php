<?php
// usuarios.php - Archivo principal de funciones para la gestión de usuarios con PDO

// Función para registrar un nuevo usuario
function registrarUsuario($nombre, $email, $password, $conn) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashedPassword);
    return $stmt->execute();
}

// Función para listar todos los usuarios
function listarUsuarios($conn, $limite, $offset) {
    $stmt = $conn->prepare("SELECT * FROM usuarios LIMIT :limite OFFSET :offset");
    $stmt->bindParam(":limite", $limite, PDO::PARAM_INT);
    $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para buscar usuarios
function buscarUsuarios($query, $conn) {
    $likeQuery = "%$query%";
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre LIKE :query OR email LIKE :query");
    $stmt->bindParam(":query", $likeQuery);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para actualizar información de un usuario
function actualizarUsuario($id, $nombre, $email, $password, $conn) {
    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, password = :password WHERE id = :id");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
    }
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
}

// Función para eliminar un usuario
function eliminarUsuario($id, $conn) {
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
}