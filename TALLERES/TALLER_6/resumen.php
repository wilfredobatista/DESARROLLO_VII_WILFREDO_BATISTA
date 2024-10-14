<?php
// Leer los datos del archivo JSON
$registros = [];
if (file_exists('registros.json')) {
    $registros = json_decode(file_get_contents('registros.json'), true);
}

// Mostrar los registros en una tabla
if (!empty($registros)) {
    echo "<h2>Resumen de Registros:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Email</th><th>Edad</th><th>Sitio Web</th><th>Género</th><th>Intereses</th><th>Comentarios</th><th>Foto de Perfil</th></tr>";
    foreach ($registros as $registro) {
        echo "<tr>";
        echo "<td>{$registro['nombre']}</td>";
        echo "<td>{$registro['email']}</td>";
        echo "<td>{$registro['edad']}</td>";
        echo "<td>{$registro['sitioWeb']}</td>";
        echo "<td>{$registro['genero']}</td>";
        echo "<td>" . implode(", ", $registro['intereses']) . "</td>";
        echo "<td>{$registro['comentarios']}</td>";
        echo "<td><img src='{$registro['foto_perfil']}' width='100'></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay registros disponibles.</p>";
}
?>