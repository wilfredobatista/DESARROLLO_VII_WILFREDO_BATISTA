<?php
// 1. Definir el arreglo de libros
$biblioteca = [
    [
        "titulo" => "Cien años de soledad",
        "autor" => "Gabriel García Márquez",
        "año" => 1967,
        "genero" => "Realismo mágico",
        "prestado" => true
    ],
    [
        "titulo" => "1984",
        "autor" => "George Orwell",
        "año" => 1949,
        "genero" => "Ciencia ficción",
        "prestado" => false
    ],
    [
        "titulo" => "El principito",
        "autor" => "Antoine de Saint-Exupéry",
        "año" => 1943,
        "genero" => "Literatura infantil",
        "prestado" => true
    ],
    [
        "titulo" => "Don Quijote de la Mancha",
        "autor" => "Miguel de Cervantes",
        "año" => 1605,
        "genero" => "Novela",
        "prestado" => false
    ],
    [
        "titulo" => "Orgullo y prejuicio",
        "autor" => "Jane Austen",
        "año" => 1813,
        "genero" => "Novela romántica",
        "prestado" => true
    ]
];

// 2. Función para imprimir la biblioteca
function imprimirBiblioteca($libros)
{
    foreach ($libros as $libro) {
        echo "{$libro['titulo']} - {$libro['autor']} ({$libro['año']}) - {$libro['genero']} - " .
            ($libro['prestado'] ? "Prestado" : "Disponible") . "\n<br>";
    }
    echo "\n";
}

echo "Biblioteca original:\n<br><br>";
imprimirBiblioteca($biblioteca);

// 3. Ordenar libros por año de publicación (del más antiguo al más reciente)
usort($biblioteca, function ($a, $b) {
    return $a['año'] - $b['año'];
});

echo "<br><br>Libros ordenados por año de publicación:\n<br><br>";
imprimirBiblioteca($biblioteca);

// 4. Ordenar libros alfabéticamente por título
usort($biblioteca, function ($a, $b) {
    return strcmp($a['titulo'], $b['titulo']);
});

echo "<br><br>Libros ordenados alfabéticamente por título:\n<br><br>";
imprimirBiblioteca($biblioteca);

// 5. Filtrar libros disponibles (no prestados)
$librosDisponibles = array_filter($biblioteca, function ($libro) {
    return !$libro['prestado'];
});

echo "<br><br>Libros disponibles:\n<br><br>";
imprimirBiblioteca($librosDisponibles);

// 6. Filtrar libros por género
function filtrarPorGenero($libros, $genero)
{
    return array_filter($libros, function ($libro) use ($genero) {
        return strcasecmp($libro['genero'], $genero) === 0;
    });
}

$librosCienciaFiccion = filtrarPorGenero($biblioteca, "Ciencia ficción");
echo "<br><br>Libros de Ciencia ficción:\n<br><br>";
imprimirBiblioteca($librosCienciaFiccion);

// 7. Obtener lista de autores únicos
$autores = array_unique(array_column($biblioteca, 'autor'));
sort($autores);

echo "<br><br>Lista de autores:\n<br><br>";
foreach ($autores as $autor) {
    echo "- $autor\n<br>";
}
echo "\n";

// 8. Calcular el año promedio de publicación
$añoPromedio = array_sum(array_column($biblioteca, 'año')) / count($biblioteca);
echo "Año promedio de publicación: " . round($añoPromedio, 2) . "\n\n";

// 9. Encontrar el libro más antiguo y el más reciente
$libroMasAntiguo = array_reduce($biblioteca, function ($carry, $libro) {
    return (!$carry || $libro['año'] < $carry['año']) ? $libro : $carry;
});

$libroMasReciente = array_reduce($biblioteca, function ($carry, $libro) {
    return (!$carry || $libro['año'] > $carry['año']) ? $libro : $carry;
});

echo "Libro más antiguo: {$libroMasAntiguo['titulo']} ({$libroMasAntiguo['año']})\n";
echo "Libro más reciente: {$libroMasReciente['titulo']} ({$libroMasReciente['año']})\n\n";



//  10. TAREA: Implementa una función de búsqueda que permita buscar libros por título o autor
// La función debe ser capaz de manejar búsquedas parciales y no debe ser sensible a mayúsculas/minúsculas
function buscarLibros($biblioteca, $termino)
{
    return array_filter($biblioteca, function ($libro) use ($termino) {
        $termino = strtolower($termino);
        return strpos(strtolower($libro['titulo']), $termino) !== false ||
            strpos(strtolower($libro['autor']), $termino) !== false;
    });
}

// Ejemplo de uso de la función de búsqueda
$resultadosBusqueda = buscarLibros($biblioteca, "quijote");
echo "<br><br>Resultados de búsqueda para 'quijote':\n<br><br>";
imprimirBiblioteca($resultadosBusqueda);



// 11. Función que genera un reporte de la biblioteca
function generarReporteBiblioteca($biblioteca) {
    $totalLibros = count($biblioteca);
    $librosPrestados = count(array_filter($biblioteca, function($libro) {
        return $libro['prestado'];
    }));
    
    $conteoGeneros = array_count_values(array_column($biblioteca, 'genero'));
    
    $autores = array_column($biblioteca, 'autor');
    $conteoAutores = array_count_values($autores);
    $autorMasLibros = array_search(max($conteoAutores), $conteoAutores);
    
    // Crear el reporte en formato de texto
    $reporte = "Reporte de la Biblioteca:\n";
    $reporte .= "Número total de libros: $totalLibros\n";
    $reporte .= "Número de libros prestados: $librosPrestados\n";
    $reporte .= "Número de libros por género:\n";
    foreach ($conteoGeneros as $genero => $cantidad) {
        $reporte .= "  - $genero: $cantidad\n";
    }
    $reporte .= "Autor con más libros: $autorMasLibros\n";
    
    return $reporte;
}
echo "<br><br>";
// Ejemplo de uso de la función de reporte
// echo "<br><br>Reporte de la Biblioteca:\n<br><br>";
echo nl2br(generarReporteBiblioteca($biblioteca));
?>