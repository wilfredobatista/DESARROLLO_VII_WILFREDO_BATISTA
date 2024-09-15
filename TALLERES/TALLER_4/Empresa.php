<?php

// require_once 'C:\laragon\www\TALLERES\TALLER_4\Evaluable.php';
// class Empresa{



//     function Agregar_empleados(){

//     }
// function Listar_empleados(){}
// function Calcular_nomina(){}

// function evaluarDesempenio(){}
// }

require_once 'C:\laragon\www\TALLERES\TALLER_4\Empleado.php';
require_once 'C:\laragon\www\TALLERES\TALLER_4\Evaluable.php';

class Empresa
{
    private $empleados = [];

    function Agregar_empleados(Empleado $empleado)
    {
        $this->empleados[] = $empleado;
    }

    function Listar_empleados()
    {
        foreach ($this->empleados as $empleado) {
            echo "Nombre: " . $empleado->getNombre() . ", ID: " . $empleado->getID_empleado() . ", Salario: " . $empleado->getSalario_base() . "<br>";
        }
    }

    function Calcular_nomina()
    {
        $total = 0;
        foreach ($this->empleados as $empleado) {
            $total += $empleado->getSalario_base();
        }
        return $total;
    }

    function evaluarDesempenio()
    {
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Evaluable) {
                echo $empleado->evaluarDesempenio() . "<br>";
            }
        }
    }
}
