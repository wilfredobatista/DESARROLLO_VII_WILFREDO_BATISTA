<?php

// require_once 'C:\laragon\www\TALLERES\TALLER_4\Empleado.php';
// require_once 'C:\laragon\www\TALLERES\TALLER_4\Evaluable.php';

// class Gerente extends Empleado implements Evaluable{
// private $Meta_ventas;
// private $Evaluacion;
// private $Bono;


// function setMeta_ventas($Meta_ventas){
// $this->Meta_ventas= $Meta_ventas;
// }
// function getMeta_ventas(){
//     return $this->Meta_ventas;
// }



// function setBono($Bono){

//     $this ->Bono= $Bono;
// }
// function getBono(){
//     return $this ->Bono;
// }


// function Asignar_bonos($bono ){

//     return $bono;
// }

// function evaluarDesempenio() 
// {

// }

// }

require_once 'C:\laragon\www\TALLERES\TALLER_4\Empleado.php';
require_once 'C:\laragon\www\TALLERES\TALLER_4\Evaluable.php';

class Gerente extends Empleado implements Evaluable
{
    private $Meta_ventas;
    private $Bono;

    function setMeta_ventas($Meta_ventas)
    {
        $this->Meta_ventas = $Meta_ventas;
    }

    function getMeta_ventas()
    {
        return $this->Meta_ventas;
    }

    function setBono($Bono)
    {
        $this->Bono = $Bono;
    }

    function getBono()
    {
        return $this->Bono;
    }

    function Asignar_bonos($bono)
    {
        $this->Bono = $bono;
        return $this->Bono;
    }

    function evaluarDesempenio()
    {
        // Implementar lógica específica para evaluar desempeño del gerente
        return "Desempeño del gerente evaluado.";
    }
}
