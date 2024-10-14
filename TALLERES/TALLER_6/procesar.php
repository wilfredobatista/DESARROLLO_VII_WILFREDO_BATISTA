<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Iniciar sesión para la persistencia de datos


    $errores = [];
    $datos = [];
    session_start();
    // Procesar y validar cada campo
    $campos = ['nombre', 'email', 'FechaNacimiento','sitioWeb', 'genero', 'intereses', 'comentarios'];
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];
            $valorSanitizado = call_user_func("sanitizar" . ucfirst($campo), $valor);
            $datos[$campo] = $valorSanitizado;

            if (!call_user_func("validar" . ucfirst($campo), $valorSanitizado)) {
                $errores[] = "El campo $campo no es válido.";
            }
        }
    }

    // Calcular la edad a partir de la fecha de nacimiento
    // $fechaNacimiento = DateTime::createFromFormat('Y-m-d', $datos['fechaNacimiento']); // Corrección: usar 'fecha_nacimiento'
    // $hoy = new DateTime();
    // $edad = $hoy->diff($fechaNacimiento)->y;
    // $datos['edad'] = $edad;

    // Procesar la foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Generar un nombre único para la foto de perfil
        $extension = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
        $nombreUnico = uniqid() . '.' . $extension;
        $rutaDestino = 'uploads/' . $nombreUnico;

        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es válida.";
        } else {
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                $datos['foto_perfil'] = $rutaDestino;
            } else {
                $errores[] = "Hubo un error al subir la foto de perfil.";
            }
        }
    }

    // Mostrar resultados o errores
    if (empty($errores)) {
        // ... (código para mostrar los datos en una tabla) ...

        // Guardar los datos en un archivo JSON
        $registros = [];
        if (file_exists('registros.json')) {
            $registros = json_decode(file_get_contents('registros.json'), true);
        }
        $registros[] = $datos;
        file_put_contents('registros.json', json_encode($registros));

        // Limpiar la sesión después de procesar el formulario correctamente
        $_SESSION = array();
        // session_destroy();

    } else {
        // ... (código para mostrar los errores en una lista) ...

        // Guardar los datos en la sesión para la persistencia
        $_SESSION['datos'] = $datos;
    }
    echo "<br><a href='formulario.html'>Volver al formulario</a>";
  

} else {
    echo "Acceso no permitido.";
}
?>





