<?php
function validarNombre($nombre) {
    return !empty($nombre) && strlen($nombre) <= 50;
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarEdad($edad) {
    return is_numeric($edad) && $edad >= 18 && $edad <= 120;
}

function validarSitioWeb($sitioWeb) {
    return empty($sitioWeb) || filter_var($sitioWeb, FILTER_VALIDATE_URL);
}

function validarGenero($genero) {
    $generosValidos = ['masculino', 'femenino', 'otro'];
    return in_array($genero, $generosValidos);
}

function validarIntereses($intereses) {
    $interesesValidos = ['deportes', 'musica', 'lectura'];
    return !empty($intereses) && count(array_intersect($intereses, $interesesValidos)) === count($intereses);
}

function validarComentarios($comentarios) {
    return strlen($comentarios) <= 500;
}

function validarFotoPerfil($archivo) {
    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
    $tamanoMaximo = 1 * 1024 * 1024; // 1MB

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    if (!in_array($archivo['type'], $tiposPermitidos)) {
        return false;
    }

    if ($archivo['size'] > $tamanoMaximo) {
        return false;
    }

    return true;
}









function validarFechaNacimiento($fechaNacimiento){
//verificamos que la fecha no este vacia
if (empty($fechaNacimiento)) {
    return false;
}
//convertimos la fecha en un objeto DataTime
$fecha = DateTime::createFromFormat('Y-m-d',$fechaNacimiento);

// Verificar si la fecha es válida
if (!$fecha) {
    return false;
}

// Calcular la edad
$hoy = new DateTime();
$edad = $hoy->diff($fecha)->y;

// Verificar que la edad esté entre 18 y 120 años
return $edad >= 18 && $edad <= 120;
}

?>