<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require 'config.php';

// Mensaje para confirmar que la conexión fue exitosa
echo "Conexión exitosa a la base de datos<br>";

// Realizar una consulta para listar los libros en la biblioteca
try {
    $stmt = $conn->query("SELECT * FROM libros");
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se obtuvieron resultados
    if ($libros) {
        echo "<h2>Lista de Libros</h2>";
        echo "<ul>";
        foreach ($libros as $libro) {
            echo "<li>" . htmlspecialchars($libro['titulo']) . " - " . htmlspecialchars($libro['autor']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No se encontraron libros en la biblioteca.";
    }
} catch (PDOException $e) {
    echo "Error al realizar la consulta: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Biblioteca</title>
    <link rel="stylesheet" href="styles.css"> <!-- Opcional: si quieres agregar estilos -->
</head>
<body>
    <header>
        <h1>Sistema de Gestión de Biblioteca</h1>
    </header>
    <main>
        <?php
        // Incluir el archivo de configuración para la conexión a la base de datos
        require 'config.php';

        // Mensaje para confirmar que la conexión fue exitosa
        echo "<p>Conexión exitosa a la base de datos</p>";

        // Realizar una consulta para listar los libros en la biblioteca
        try {
            $stmt = $conn->query("SELECT * FROM libros");
            $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Verificar si se obtuvieron resultados
            if ($libros) {
                echo "<h2>Lista de Libros</h2>";
                echo "<ul>";
                foreach ($libros as $libro) {
                    echo "<li>" . htmlspecialchars($libro['titulo']) . " - " . htmlspecialchars($libro['autor']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No se encontraron libros en la biblioteca.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Error al realizar la consulta: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Sistema de Gestión de Biblioteca</p>
    </footer>
</body>
</html>




