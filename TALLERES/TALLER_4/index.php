<?php
require_once 'C:\laragon\www\TALLERES\TALLER_4\Empleado.php';
require_once 'C:\laragon\www\TALLERES\TALLER_4\Evaluable.php';
require_once 'C:\laragon\www\TALLERES\TALLER_4\Desarrollador.php';
require_once 'C:\laragon\www\TALLERES\TALLER_4\Gerente.php';
require_once 'C:\laragon\www\TALLERES\TALLER_4\Empresa.php';

// Crear instancias de empleados
$desarrollador = new Desarrollador();
$desarrollador->setNombre("Carlos");
$desarrollador->setID_empleado(101);
$desarrollador->setSalario_base(3000);
$desarrollador->setLenguaje_principal("PHP");
$desarrollador->setNivel_experiencia("Senior");

$gerente = new Gerente();
$gerente->setNombre("Ana");
$gerente->setID_empleado(102);
$gerente->setSalario_base(5000);
$gerente->setMeta_ventas(100000);
$gerente->Asignar_bonos(1000);

// Crear instancia de Empresa
$empresa = new Empresa();
$empresa->Agregar_empleados($desarrollador);
$empresa->Agregar_empleados($gerente);

// Listar empleados
echo "<h2>Listado de Empleados:</h2>";
$empresa->Listar_empleados();

// Calcular nómina
echo "<h2>Nómina Total:</h2>";
echo $empresa->Calcular_nomina() . "<br>";

// Evaluar desempeño
echo "<h2>Evaluaciones de Desempeño:</h2>";
$empresa->evaluarDesempenio();
?>

