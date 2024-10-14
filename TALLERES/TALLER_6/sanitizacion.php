<?php
function sanitizarNombre($nombre) {
    return (trim($nombre));
}

function sanitizarEmail($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

function sanitizarEdad($edad) {
    return filter_var($edad, FILTER_SANITIZE_NUMBER_INT);
}

function sanitizarSitioWeb($sitioWeb) {
    return filter_var(trim($sitioWeb), FILTER_SANITIZE_URL);
}

function sanitizarGenero($genero) {
    return (trim($genero));
}

function sanitizarIntereses($intereses) {
    return array_map(function($interes) {
        return (trim($interes));
    }, $intereses);
}

function sanitizarComentarios($comentarios) {
    return htmlspecialchars(trim($comentarios), ENT_QUOTES, 'UTF-8');
}






function sanitizarFechaNacimiento($fechaNacimiento){

    //elinimanos todos los espacios en blando y sanitizamos la fecha
    return (trim($fechaNacimiento));
}





?>