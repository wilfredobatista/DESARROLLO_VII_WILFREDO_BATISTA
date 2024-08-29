
<?php
// Ejemplo de uso de strlen()
$nombre = "Juan Pérez";
$longitud = strlen($nombre);

echo "El nombre '$nombre' tiene $longitud caracteres. <br> <br>";

// Ejercicio: Crea una variable con tu nombre completo y usa strlen() para mostrar su longitud
$miNombre = "Wilfredo Batista"; // Reemplaza esto con tu nombre completo
$longitudMiNombre = strlen($miNombre);


echo "Mi nombre completo es Wilfredo Batista y  tiene $longitudMiNombre caracteres.";


$categoria = categorizarLongitud($miNombre);
echo "
Mi nombre es considerado $categoria.";

// Bonus: Crea una función que tome un string como parámetro y devuelva si es "corto" (menos de 5 caracteres), "medio" (entre 5 y 10 caracteres) o "largo" (más de 10 caracteres)
function categorizarLongitud($texto) {
    $longitud = strlen($texto);
    if ($longitud < 5) {
        return "corto";
    } elseif ($longitud <= 10) {
        return "medio";
    } else {
        return "largo";
    }
    //estamos haciendo comentarios
}
?>