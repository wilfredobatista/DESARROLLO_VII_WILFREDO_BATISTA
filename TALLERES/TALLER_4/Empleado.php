<?php
// require_once 'C:\laragon\www\TALLERES\TALLER_4\Evaluable.php';
// class Empleado
// {
//     private $Nombre;
//     private $ID_empleado;
//     private $Salario_base;
//     private $Evaluacion;


//     function setNombre($Nombre)
//     {
//         $this->Nombre = $Nombre;
//     }
//     function getNombre()
//     {
//         return $this->Nombre;
//     }


//     function setID_empleado($ID_empleado)
//     {
//         $this->ID_empleado = $ID_empleado;
//     }
//     function getID_empleado()
//     {
//         return $this->ID_empleado;
//     }


//     function setSalario_base($Salario_base)
//     {
//         $this-> Salario_base= $Salario_base;
//     }
//     function getSalario_base()
//     {
//         return $this->Salario_base;
//     }


//     function evaluarDesempenio(){}
// }

require_once 'C:\laragon\www\TALLERES\TALLER_4\Evaluable.php';

class Empleado
{
    private $Nombre;
    private $ID_empleado;
    private $Salario_base;

    function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    function getNombre()
    {
        return $this->Nombre;
    }

    function setID_empleado($ID_empleado)
    {
        $this->ID_empleado = $ID_empleado;
    }

    function getID_empleado()
    {
        return $this->ID_empleado;
    }

    function setSalario_base($Salario_base)
    {
        $this->Salario_base = $Salario_base;
    }

    function getSalario_base()
    {
        return $this->Salario_base;
    }

    function evaluarDesempenio()
    {
        // Método vacío para ser sobrescrito en clases hijas
    }
}
