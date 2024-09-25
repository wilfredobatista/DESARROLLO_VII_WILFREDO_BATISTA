<?php
// Archivo: clases.php

interface Detalle
{
    public  function DetallesEspecificos($string);
}
class Tarea implements Detalle
{
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;


    public function __construct($datos)
    {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }

    // Implementar estos getters
    public function getEstado()
    {
        return $this->estado;
    }
    public function getPrioridad()
    {
        return $this->prioridad;
    }
    public  function DetallesEspecificos($string) {}
}

class GestorTareas
{
    private $tareas = [];

    public function cargarTareas()
    {
        $json = file_get_contents('tareas.json');
        $data = json_decode($json, true);
        foreach ($data as $tareaData) {
            switch ($tareaData['tipo']){
                case'desarrollo':
                    $tarea= new TareaDesarrollo($tareaData);
                    break;
                case'diseno':
                    $tarea= new TareaDiseno($tareaData);
                    break;
                case 'testing':
                    $tarea= new TareaTesting($tareaData);
                    break;
            }
            // $this ->tarea[]= $tarea;
            
            $tarea = new Tarea($tareaData);
            $this->tareas[] = $tarea;
        }

        return $this->tareas;
    }


function agregarTarea($tarea){


}
function eliminarTarea($id){}

}



class TareaDesarrollo extends Tarea
{
    public $lenguajeProgramacion = " ";

    public function DetallesEspecificos($lenguaje)
    { //retorna el nombre del lenguaje

        return $lenguaje;
    }
}

class TareaDiseno extends Tarea
{ //devuelve una caden con el tipo de tarea
    public $herramientaDiseno = "";

    public function DetallesEspecificos($string)
    {
        return $string;
    }
}



class TareaTesting extends Tarea
{
    public $tipoTest;
    public function DetallesEspecificos($tring) {}
}


// class Prueba {
//     private $tipoTest;

//     public function __construct($tipoTest) {
//         $this->setTipoTest($tipoTest);
//     }

//     public function setTipoTest($tipoTest) {
//         $tiposValidos = ['unitario', 'integracion', 'e2e'];
//         if (in_array($tipoTest, $tiposValidos)) {
//             $this->tipoTest = $tipoTest;
//         } else {
//             throw new Exception("Tipo de test inválido. Debe ser 'unitario', 'integracion', o 'e2e'.");
//         }
//     }

//     public function getTipoTest() {
//         return $this->tipoTest;
//     }
// }




// Implementar:
// 1. La interfaz Detalle
// 2. Modificar la clase Tarea para implementar la interfaz Detalle
// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea