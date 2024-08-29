
<?php
// Ejemplo de uso de explode()
$frase = "Manzana,Naranja,Plátano,Uva";
$frutas = explode(",", $frase);

echo "Frase original: $frase</br>";
echo "Array de frutas:</br>";
print_r($frutas);

// Ejercicio: Crea una variable con una lista de tus 5 películas favoritas separadas por guiones (-)
// y usa explode() para convertirla en un array
$misPeliculas = "Tren nocturno a Kadmandu, Harry Potter, Los Advenger, El señor de los anillos, Sherk"; // Reemplaza esto con tu lista de películas
$arrayPeliculas = explode("-", $misPeliculas);

echo "</br> <br>Mis películas favoritas:</br>";
print_r($arrayPeliculas);

// Bonus: Usa explode() con un límite
$texto = "Uno,Dos,Tres,Cuatro,Cinco";
$array = explode(",", $texto, 5);

echo "</br><br>Texto original: $texto</br>";
echo "Array con límite:</br>";
print_r($array);
?>
      
