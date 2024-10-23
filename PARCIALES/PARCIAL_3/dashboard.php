<?php
session_start();
require_once 'lista_estudiantes.php';

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <h2>Bienvenido Estudiante</h2>


<table>
    <?php
    foreach ($lista_de_estudiantes as $key) {
    ?>

        <tr>
            <th>nombre del estudiante </th>
            <th>calificaciones</th>
        </tr>

        <tr>
            <td><?php echo $key['estudiante']; ?> </td>
            <td><?php echo $key['calificaciones']; ?></td>



        </tr>
    <?php
    }
    ?>
    </table>



     <a href="logout.php">Cerrar Sesión</a>
</body>

</html>