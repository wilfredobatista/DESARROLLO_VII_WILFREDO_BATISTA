
<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';


session_start(); // inicio de sesion

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $datos = [];

    // Procesar y validar cada campo
    $campos = ['nombre', 'email', 'edad','fechaNacimiento', 'sitioWeb', 'genero', 'intereses', 'comentarios'];
   
    var_dump($campos);
   
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {


           
            $valor = $_POST[$campo];
            $valorSanitizado = call_user_func("sanitizar" . ucfirst($campo), $valor);
            $datos[$campo] = $valorSanitizado;

            if (!call_user_func("validar" . ucfirst($campo), $valorSanitizado)) {
                $errores[] = "El campo $campo no es válido.";
                $_SESSION[$campo] = $valor; // Guardar el valor ingresado en la sesió
            } else {
                // Limpiar el valor de la sesión si no hay errores
                unset($_SESSION[$campo]);
            }
        }
    }


    // Calcular la edad a partir de la fecha de nacimiento
    if (isset($_POST['fecha_nacimiento'])) {
        $fechaNacimiento = $_POST['fecha_nacimiento'];
        $edad = (new DateTime())->diff(new DateTime($fechaNacimiento))->y; // Calcula la edad
        $datos['edad'] = $edad;  // Almacena la edad en el array de datos
    }







    // Procesar la foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es válida.";
        } else {
            // Definir la ruta de destino
            $nombreArchivo = basename($_FILES['foto_perfil']['name']);
            $rutaDestino = 'uploads/' . $nombreArchivo;

            // Verificar si el archivo ya existe y cambiar el nombre si es necesario
            $contador = 1;
            while (file_exists($rutaDestino)) {
                $nombreArchivoSinExt = pathinfo($nombreArchivo, PATHINFO_FILENAME);
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                $nombreArchivo = $nombreArchivoSinExt . '_' . $contador . '.' . $extension;
                $rutaDestino = 'uploads/' . $nombreArchivo;
                $contador++;
            }

            // Mover el archivo a la carpeta de uploads
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                $datos['foto_perfil'] = $rutaDestino;
            } else {
                $errores[] = "Hubo un error al subir la foto de perfil.";
            }
        }
    }








    // Mostrar resultados o errores
    // if (empty($errores)) {
    //     echo "<h2>Datos Recibidos:</h2>";
    //     foreach ($datos as $campo => $valor) {
    //         if ($campo === 'intereses') {
    //             echo "$campo: " . implode(", ", $valor) . "<br>";
    //         } elseif ($campo === 'foto_perfil') {
    //             echo "$campo: <img src='$valor' width='100'><br>";
    //         } else {
    //             echo "$campo: $valor<br>";
    //         }
    //     }
    // } else {
    //     echo "<h2>Errores:</h2>";
    //     foreach ($errores as $error) {
    //         echo "$error<br>";
    //     }
    // }

    // Modificar la sección de mostrar resultados
    if (empty($errores)) {
        echo "<h2>Datos Recibidos:</h2>";
        echo "<table border='1'>";
        foreach ($datos as $campo => $valor) {
            echo "<tr>";
            echo "<th>" . ucfirst($campo) . "</th>";
            if ($campo === 'intereses') {
                echo "<td>" . implode(", ", $valor) . "</td>";
            } elseif ($campo === 'foto_perfil') {
                echo "<td><img src='$valor' width='100'></td>";
            } else {
                echo "<td>$valor</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>Errores:</h2>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }

    echo "<br><a href='formulario.html'>Volver al formulario</a>";
} else {
    echo "Acceso no permitido.";
}








$archivoJson = 'registros.json';
$registros = [];

if (file_exists($archivoJson)) {
    $registros = json_decode(file_get_contents($archivoJson), true);
}

$registros[] = $datos;  // Agregar el nuevo registro

file_put_contents($archivoJson, json_encode($registros));

header('Location: resumen.php');
    exit();


?>