<?php
session_start(); // Asegúrate de que esto esté al inicio del archivo

// Cargar los registros del archivo JSON
$registros = json_decode(file_get_contents('registros.json'), true);
// var_dump($registros);
// Comprobar si hay registros para mostrar
if (empty($registros)) {
    echo "<h2>No hay registros disponibles.</h2>";
} else {
    echo "<h2>Resumen de Registros Procesados:</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Edad</th>
            <th>Fecha de Nacimiento</th>
            <th>Sitio Web</th>
            <th>Género</th>
            <th>Intereses</th>
            <th>Comentarios</th>
            <th>Foto de Perfil</th>
          </tr>";

    foreach ($registros as $registro) {
        // var_dump($registro);
        echo "<tr>";
        echo "<td>" . htmlspecialchars($registro['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($registro['email']) . "</td>";
        echo "<td>" . htmlspecialchars($registro['edad']) . "</td>";
        echo "<td>" . htmlspecialchars($registro['fechaNacimiento']) . "</td>";
        echo "<td>" . htmlspecialchars($registro['sitioWeb']) . "</td>";
        echo "<td>" . htmlspecialchars($registro['genero']) . "</td>";
        echo "<td>" . htmlspecialchars(implode(', ', $registro['intereses'])) . "</td>";
        echo "<td>" . htmlspecialchars($registro['comentarios']) . "</td>";
        echo "<td><img src='uploads/" . htmlspecialchars($registro['foto_perfil']) . "' alt='Foto de Perfil' width='50'></td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Opción para volver al formulario
echo "<br><a href='formulario.html'>Volver al formulario</a>";
