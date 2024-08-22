<?php
$asterisco="";
$impares=1;
$contador=10;
echo "<H2> TRIANGULO RECTANGULO CON * FORMADA CON CICLO FOR <br>";
//for para la piramide
for ($i = 0; $i <= 4; $i++) {
    for ($j = 0; $j <= $i; $j++) {
        echo $asterisco."*";
    }
    echo "<br>";
}

echo" <H2> IMPRIMIENDO IMPARES DEL 1 AL 20 <br> <br>";

//while para los impares de 1 a 20 
while($impares<= 20){
    if ($impares%2 !=0){
        echo $impares;
        echo "<br>";
    }
    $impares++;
}
echo "<br>";
echo "<H2> IMPRIMIENDO CONTADOR REGRESIVO DE 10 A 1 SIN IMPRIMIR EL 5<br> <br>";

do{
if ($contador!=5){
    echo $contador."<br>";
}
$contador--;

} while($contador!=0)





?>