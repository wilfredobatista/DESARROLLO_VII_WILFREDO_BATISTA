<?php
// 1. Crear un arreglo de estudiantes con sus calificaciones
$estudiantes = [
    ["nombre" => "Ana", "calificaciones" => [85, 92, 78, 96, 88]],
    ["nombre" => "Juan", "calificaciones" => [75, 84, 91, 79, 86]],
    ["nombre" => "María", "calificaciones" => [92, 95, 89, 97, 93]],
    ["nombre" => "Pedro", "calificaciones" => [70, 72, 78, 75, 77]],
    ["nombre" => "Laura", "calificaciones" => [88, 86, 90, 85, 89]]
];

// 2. Función para calcular el promedio de calificaciones
function calcularPromedio($calificaciones) {
    return array_sum($calificaciones) / count($calificaciones);
}

// 3. Función para asignar una letra de calificación basada en el promedio
function asignarLetraCalificacion($promedio) {
    if ($promedio >= 90) return 'A';
    if ($promedio >= 80) return 'B';
    if ($promedio >= 70) return 'C';
    if ($promedio >= 60) return 'D';
    return 'F';
}

// 4. Procesar y mostrar información de estudiantes
echo "Información de estudiantes:\n<br><br>";
foreach ($estudiantes as &$estudiante) {
    $promedio = calcularPromedio($estudiante["calificaciones"]);
    $estudiante["promedio"] = $promedio;
    $estudiante["letra_calificacion"] = asignarLetraCalificacion($promedio);
    
    echo "{$estudiante['nombre']}:\n<br>";
    echo "  Calificaciones: " . implode(", ", $estudiante["calificaciones"]) . "\n<br>";
    echo "  Promedio: " . number_format($promedio, 2) . "\n<br>";
    echo "  Calificación: {$estudiante['letra_calificacion']}\n\n<br><br>";
}

// 5. Encontrar al estudiante con el promedio más alto
$mejorEstudiante = array_reduce($estudiantes, function($mejor, $actual) {
    return (!$mejor || $actual["promedio"] > $mejor["promedio"]) ? $actual : $mejor;
});

echo "Estudiante con el promedio más alto: {$mejorEstudiante['nombre']} ({$mejorEstudiante['promedio']})\n<br>";

// 6. Calcular y mostrar el promedio general de la clase
$promedioGeneral = array_sum(array_column($estudiantes, "promedio")) / count($estudiantes);
echo "Promedio general de la clase: " . number_format($promedioGeneral, 2) . "\n<br>";

// 7. Contar estudiantes por letra de calificación
$conteoCalificaciones = array_count_values(array_column($estudiantes, "letra_calificacion"));
echo "Distribución de calificaciones:\n<br>";
foreach ($conteoCalificaciones as $letra => $cantidad) {
    echo "$letra: $cantidad estudiante(s)\n";
}
echo "<br><br>";
// TAREA: Implementa una función que identifique a los estudiantes que necesitan tutoría
// (aquellos con un promedio menor a 75) y otra que liste a los estudiantes de honor
// (aquellos con un promedio de 90 o más).
// Tu código aquí

//Función para identificar a los estudiantes que necesitan tutoría
function estudiantesNecesitanTutoria($estudiantes) {
    return array_filter($estudiantes, function($estudiante) {
        return $estudiante["promedio"] < 75;
    });
}

//Función para listar a los estudiantes de honor
function estudiantesDeHonor($estudiantes) {
    return array_filter($estudiantes, function($estudiante) {
        return $estudiante["promedio"] >= 90;
    });
}

// Llamar y mostrar estudiantes que necesitan tutoría
$estudiantesTutoria = estudiantesNecesitanTutoria($estudiantes);
echo "Estudiantes que necesitan tutoría:\n";
foreach ($estudiantesTutoria as $estudiante) {
    echo "{$estudiante['nombre']} (Promedio: " . number_format($estudiante["promedio"], 2) . ")\n";
}
echo "\n <br><br>";

// Llamar y mostrar estudiantes de honor
$estudiantesHonor = estudiantesDeHonor($estudiantes);
echo "Estudiantes de honor:\n";
foreach ($estudiantesHonor as $estudiante) {
    echo "{$estudiante['nombre']} (Promedio: " . number_format($estudiante["promedio"], 2) . ")\n";
}
?>