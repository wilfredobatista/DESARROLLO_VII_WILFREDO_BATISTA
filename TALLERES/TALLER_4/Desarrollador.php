<?php
// require_once 'C:\laragon\www\TALLERES\TALLER_4\Empleado.php';

// class Desarrollador extends Empleado implements Evaluable
// {

//     private $Lenguaje_principal;
//     private $Nivel_experiencia;

//     function setLenguje_principal($Lenguaje_principal)
//     {
//         $this->Lenguaje_principal = $Lenguaje_principal;
//     }
//     function getLenguaje_principal()
//     {
//         return $this->Lenguaje_principal;
//     }



//     function setNivel_experiencia($Nivel_experiencia)
//     {
//         $this->Nivel_experiencia = $Nivel_experiencia;
//     }
//     function getNivel_experiencia()
//     {
//         return $this->Nivel_experiencia;
//     }


//     function evaluarDesempenio()
//     {
        
//     }
// }

require_once 'C:\laragon\www\TALLERES\TALLER_4\Empleado.php';
require_once 'C:\laragon\www\TALLERES\TALLER_4\Evaluable.php';

class Desarrollador extends Empleado implements Evaluable
{
    private $Lenguaje_principal;
    private $Nivel_experiencia;

    function setLenguaje_principal($Lenguaje_principal)
    {
        $this->Lenguaje_principal = $Lenguaje_principal;
    }

    function getLenguaje_principal()
    {
        return $this->Lenguaje_principal;
    }

    function setNivel_experiencia($Nivel_experiencia)
    {
        $this->Nivel_experiencia = $Nivel_experiencia;
    }

    function getNivel_experiencia()
    {
        return $this->Nivel_experiencia;
    }

    function evaluarDesempenio()
    {
        // Implementar lógica específica para evaluar desempeño del desarrollador
        return "Desempeño del desarrollador evaluado.";
    }
}
