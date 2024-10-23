<?php
session_start();

// Usuarios predefinidos (usuario => contraseña)
$estudiantes = [
    'estudiante1' => 'password1',
    'profesor1' => 'password2',
];

$mensaje_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_estudiante = $_POST['estudiante'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Validar credenciales
    if (isset($estudiantes[$nombre_estudiante]) && $estudiantes[$nombre_estudiante] === $contrasena) {

        //validamo los datos 
        if (strlen($nombre_estudiante) >= 5 && strlen($contrasena) >= 5) {
            $_SESSION['estudiante'] = $nombre_estudiante;
            header('Location: dashboard.php');
        }




        exit;
    } else {
        $mensaje_error = 'Credenciales incorrectas.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio de general</title>
</head>

<body>
    <h2>Inicio de general</h2>
    <form action="" method="post">

        <h3>login para estudiantes</h3>
        <label for="estudiante">Usuario:</label>
        <input type="text" name="estudiante" id="estudiante" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>


    <form action="" method="post">

        <h3>login para porfesores</h3>
        <label for="profesores">Usuario:</label>
        <input type="text" name="profesores" id="profesores" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>


    <?php if ($mensaje_error): ?>
        <p style="color: red;"><?php echo $mensaje_error; ?></p>
    <?php endif; ?>
</body>

</html>