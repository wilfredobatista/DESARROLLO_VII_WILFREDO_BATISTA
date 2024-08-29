
<?php
// Ejemplo de uso de str_replace()
$frase = "El gato negro saltó sobre el perro negro";
$fraseModificada = str_replace("negro", "blanco", $frase);

echo "Frase original: $frase <br>";
echo "Frase modificada: $fraseModificada<br><br>";

// Ejercicio: Crea una variable con una frase que contenga al menos tres veces la palabra "PHP"
// y usa str_replace() para cambiar "PHP" por "JavaScript"
$miFrase = "Pablito corto un pelito de la calva de un calvito"; // Reemplaza esto con tu frase
$miFraseModificada = str_replace("corto", "pinto", $miFrase);

echo "
Mi frase original: $miFrase <br>";
echo "Mi frase modificada: $miFraseModificada <br><br>";

// Bonus: Usa str_replace() para reemplazar múltiples palabras a la vez
$texto = "Manzanas y naranjas son frutas. Me gustan las Manzanas y las naranjas.";
$buscar = ["Manzanas", "naranjas"];
$reemplazar = ["Peras", "uvas"];
$textoModificado = str_replace($buscar, $reemplazar, $texto);

echo "Texto original: $texto <br>";
echo "Texto modificado: $textoModificado <br>";
?>