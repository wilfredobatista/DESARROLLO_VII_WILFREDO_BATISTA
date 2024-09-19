<?php
class Estudiante
{
    private $id;
    private $nombre;
    private $edad;
    private $carrera;
    private $materias = [];

    public function __construct($id, $nombre, $edad, $carrera)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
    }

    public function agregarMateria($materia, $calificacion)
    {
        $this->materias[$materia] = $calificacion;
    }

    public function obtenerPromedio()
    {
        // if (count($this->materias) === 0) {
        //     return 0;
        // }
        return array_sum($this->materias) / count($this->materias);
    }

    public function obtenerDetalles()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'carrera' => $this->carrera,
            'materias' => $this->materias,
            'promedio' => $this->obtenerPromedio()
        ];
    }

    public function __toString()
    {
        return "Estudiante:<br> $this->nombre (ID: $this->id), Carrera: $this->carrera, Promedio: " . $this->obtenerPromedio();
    }
}
//----------------------------------------------------------
class SistemaGestionEstudiantes {
    //arreglo para almacenar los objetos estudiante
    private $estudiantes = [];
    private $graduados = [];

    public function agregarEstudiante($estudiante) {
        $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
    }

    public function obtenerEstudiante($id) {
        return $this->estudiantes[$id] ;//??null;
    }

    public function listarEstudiantes() {
        //retornamos estu
        return $this->estudiantes;
    }

    public function calcularPromedioGeneral() {
        $totalPromedio = array_reduce($this->estudiantes, function($carry, $estudiante) {
            return $carry + $estudiante->obtenerPromedio();
        }, 0);
        return $totalPromedio / count($this->estudiantes);
    }

    public function obtenerEstudiantesPorCarrera($carrera) {
        return array_filter($this->estudiantes, function($estudiante) use ($carrera) {
            return $estudiante->obtenerDetalles()['carrera'] === $carrera;
        });
    }

    public function obtenerMejorEstudiante() {
        return array_reduce($this->estudiantes, function($mejor, $estudiante) {
            return ($mejor === null || $estudiante->obtenerPromedio() > $mejor->obtenerPromedio()) ? $estudiante : $mejor;
        });
    }

    public function graduarEstudiante($id) {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[$id] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
        }
    }

    public function generarRanking() {
        usort($this->estudiantes, function($a, $b) {
            return $b->obtenerPromedio() <=> $a->obtenerPromedio();
        });
        return $this->estudiantes;
    }
}
//------------------------------------------------------------------
$sistema = new SistemaGestionEstudiantes();

// Crear algunos estudiantes de ejemplo
$est1 = new Estudiante(1, "Ana López", 20, "Ingeniería");
$est1->agregarMateria("Matemáticas", 85);
$est1->agregarMateria("Física", 90);

$est2 = new Estudiante(2, "Carlos Pérez", 22, "Medicina");
$est2->agregarMateria("Anatomía", 95);
$est2->agregarMateria("Química", 88);

$est3 = new Estudiante(3, "Maria Fernadez", 24, "Iformatica");
$est3->agregarMateria("Desaroollo", 80);
$est3->agregarMateria("Redes", 75);
$est3->agregarMateria("Biotecnica", 65);

$est4 = new Estudiante(4, "Jose Perez", 21, "Ingeniria Civil");
$est4->agregarMateria("Calculo", 92);
$est4->agregarMateria("Resistencia de los materiarles", 94);


$sistema->agregarEstudiante($est1);
$sistema->agregarEstudiante($est2);
$sistema->agregarEstudiante($est3);
$sistema->agregarEstudiante($est4);



// Mostrar estudiantes
foreach ($sistema->listarEstudiantes() as $estudiante) {
    echo $estudiante . "\n<br>";
}

// Calcular y mostrar promedio general
echo " <br>Promedio general: " . $sistema->calcularPromedioGeneral() . "\n <br>";

// Mostrar mejor estudiante
echo "<br>Mejor estudiante: " . $sistema->obtenerMejorEstudiante() . "\n";
