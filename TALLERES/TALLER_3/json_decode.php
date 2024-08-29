
<?php
// Ejemplo de uso de json_decode() con un JSON simple
$jsonFrutas = '["manzana","banana","naranja"]';
$frutas = json_decode($jsonFrutas);
echo "JSON de frutas decodificado:</br>";
print_r($frutas);
echo "<br>";
// Ejemplo con un JSON de objeto
$jsonPersona = '{"nombre":"Juan","edad":30,"ciudad":"Madrid"}';
$persona = json_decode($jsonPersona, true); // true para obtener un array asociativo
echo "</br>JSON de persona decodificado como array:</br>";
print_r($persona);
echo "<br>";

// Ejercicio: Decodifica el JSON de tu película favorita del ejercicio anterior
$jsonPelicula = '{"titulo":"Tren nocturno a katmandu","director":"Rober Winner","año":1980,"actores":["Eddie Castrodad","Pernell Roberts","Milla Jovovich"]}';
$peliculaFavorita = json_decode($jsonPelicula, true);
echo "</br>Información de tu película favorita decodificada:</br>";
print_r($peliculaFavorita);
echo "<br>";

// Bonus: Trabajar con JSON anidado
$jsonComplejo = '{
    "nombre": "María",
    "edad": 28,
    "hobbies": ["leer", "nadar", "viajar"],
    "direccion": {
        "calle": "Calle Principal",
        "numero": 123,
        "ciudad": "Barcelona"
    }
}';
$datosComplejos = json_decode($jsonComplejo, true);
echo "</br>JSON complejo decodificado:</br>";
print_r($datosComplejos);
echo "<br>";
echo "<br>";
// Extra: Manejo de errores en json_decode()
$jsonInvalido = '{"nombre": "Pedro", "edad": 35}'; // JSON inválido (coma extra)
$resultado = json_decode($jsonInvalido, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "</br>Error al decodificar JSON: " . json_last_error_msg();
}else {
print_r ($resultado);
};
?>