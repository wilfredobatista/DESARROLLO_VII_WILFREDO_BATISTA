<?php
$calificacion = 67;
$letra="";

$nota= ($calificacion<=59)?  " Reprobado": " Aprobado";

if ($calificacion >=0 && $calificacion <=59){
    echo "Tu calificación es F <br>". $nota."<br>";
    $letra="F";
    }elseif($calificacion >=60 && $calificacion <=69){
        echo "Tu calificación es D <br>".$nota."<br>";
        $letra="D";
    }elseif($calificacion>=70 && $calificacion<=79){
        echo "Tu calificación es C <br>".$nota."<br>";
        $letra="C";
    }elseif($calificacion >=80 && $calificacion<=89){
        echo "Tu calificación  es B <br>".$nota."<br>";
        $letra="B";
    }elseif($calificacion>=90 && $calificacion <=100){
        echo "Tu calificación  es A <br>".$nota."<br>";
        $letra="A";
    }

switch ($letra){
    case ("A"):
        echo "Exelente trabajo <br>";
        break;
    case ("B"):
        echo "Buen trabajo <br>";
        break;
    case ("C"):
        echo "Trabajo aceptable <br>";
        break;
    case ("D"):
        echo "Necesitas mejorar <br>";
        break;
    case ("F"):
        echo "Debes esforzarte más <br>";
        break;
    default:
    echo"";
    
    }
    
?>