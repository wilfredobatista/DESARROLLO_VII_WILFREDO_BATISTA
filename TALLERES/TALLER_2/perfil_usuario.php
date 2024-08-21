<?php
$nombre_completo = "Wilfredo Batista";
$edad = 40;
$correo = "Wilfredobatistamela@gmail.com";
$telefono = "67-06-72-13";
define("OCUPACION", "Estudiante");


echo "Nombre Completo: " . $nombre_completo . "<br>Edad: " . $edad . "<br>Correo: " . $correo . "<br>Teléfono: " . $telefono . "<br>Ocupación: " . OCUPACION ."<br><br>";
print "Nombre Completo: " . $nombre_completo . "<br>Edad: " . $edad . "<br>Correo: " . $correo . "<br>Teléfono: " . $telefono . "<br>Ocupación: " . OCUPACION."<br><br>";
printf("Nombre Completo: %s<br>Edad: %d<br>Correo: %s<br>Teléfono: %s<br>Ocupación: %s",$nombre_completo, $edad, $correo, $telefono, OCUPACION."<br><br>");

var_dump($nombre_completo);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($correo);
echo "<br>";
var_dump($telefono);
echo "<br>";
var_dump(OCUPACION);
?>