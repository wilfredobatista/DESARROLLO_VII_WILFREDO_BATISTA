
<?php
// Ejemplo de uso de date()
echo "Fecha actual: " . date("Y-m-d") . "</br>";
echo "Hora actual: " . date("H:i:s") . "</br>";
echo "Fecha y hora actuales: " . date("Y-m-d H:i:s") . "</br>";

// Ejercicio: Usa date() para mostrar la fecha actual en el formato "Día de la semana, día de mes de año"
// Por ejemplo: "Lunes, 15 de agosto de 2023"
$fechaFormateada = date("l, j \ F \ Y");
echo "Fecha formateada: $fechaFormateada</br>";

// Bonus: Crea una función que devuelva la diferencia en días entre dos fechas
function diasEntre($fecha1, $fecha2) {
    $timestamp1 = strtotime($fecha1);
    $timestamp2 = strtotime($fecha2);
    $diferencia = abs($timestamp2 - $timestamp1);
    return floor($diferencia / (60 * 60 * 24));
}

$fechaInicio = "2023-01-01";
$fechaFin = date("Y-m-d"); // Fecha actual
$diasTranscurridos = diasEntre($fechaInicio, $fechaFin);

echo "</br>Días transcurridos desde el $fechaInicio hasta hoy: $diasTranscurridos días</br>";

// Extra: Mostrar zona horaria actual
echo "</br>Zona horaria actual: " . date_default_timezone_get() . "</br>";

// Cambiar zona horaria y mostrar la hora
date_default_timezone_set("America/New_York");
echo "Hora en New York: " . date("H:i:s") . "</br>";
?>
      
