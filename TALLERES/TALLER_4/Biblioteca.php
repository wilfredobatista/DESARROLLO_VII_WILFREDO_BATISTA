<?php
// require_once 'Libro.php';
// require_once 'LibroDigital.php';

// Ejemplo de uso
//creamos nuevo objeto de la clase biblioteca
// $biblioteca = new Biblioteca();
//los obetos siguientes heredan de sus respectivas clases con 
//las requiere de las clases en la cabezera
//creamos tambien dos objetos, uno de la clase libro, y otro de la calse libro digital
// $libro1 = new Libro("El principito", "Antoine de Saint-Exupéry", 1943);
/*recordemos que la clase libro digital tiene dos parametros mas, privados
el de fomato de archivo y el de tamanoMB */
// $libro2 = new LibroDigital("Dune", "Frank Herbert", 1965, "EPUB", 3.2);

//el objeto biblioteca  de la clase Biblioteca hae un llamado a la funcion 
//agregar libro y le manda por parametro la variable $libro 1 y $libro2
//definidas arrba commo arrays

// $biblioteca->agregarLibro($libro1);
// $biblioteca->agregarLibro($libro2);

//----------------------------------------------------------

// class Biblioteca
// { //atributo privado 
    // private $libros = [];


    //prestable es la interface en archivo php
    // public function agregarLibro(Prestable $libro)
    // {
    /**en el llamado de esta funcion arriba  se mandan los parametros de
     * libro 1 y 2 como arreglo y this libro toma el valor de $libro que aqui es el parametro de entrada
     */
    //     $this->libros[] = $libro;
    // }

//funcion invocada con echo en la parte de abajo
    // public function listarLibros()
    //{/**como estamos dentro de la misma clase podemos hacer uso de de la varible
      //  $libros devinica en el cabecero de la clase como privada
    //*/
        
    //leemos asi, de cada iteracion del arreglo libros asignaselo a la varialble $libro
    //$libro solo existe aqui
     //   foreach ($this->libros as $libro) {
          //segun que sea libro y los parametros que tenga va a llamar a una funcion 
          // de obtenerInformacion desde el padre o desde hijo
//             echo $libro->obtenerInformacion() . "\n";
//             echo "Disponible: " . ($libro->estaDisponible() ? "Sí" : "No") . "\n\n";
//         }
//     }

    
//     public function prestarLibro($titulo)
//     {
//         foreach ($this->libros as $libro) {
//             if ($libro->getTitulo() === $titulo && $libro->estaDisponible()) {
//                 $libro->prestar();
//                 return true;
//             }
//         }
//         return false;
//     }

//     public function devolverLibro($titulo)
//     {
//         foreach ($this->libros as $libro) {
//             if ($libro->getTitulo() === $titulo && !$libro->estaDisponible()) {
//                 $libro->devolver();
//                 return true;
//             }
//         }
//         return false;
//     }
// }




//invocacion de la funcion listar libros primer llamdo
// echo "Listado inicial de libros:\n";
// $biblioteca->listarLibros();

// echo "Prestando 'El principito'...\n";
// $biblioteca->prestarLibro("El principito");

// echo "Listado después de prestar:\n";
// $biblioteca->listarLibros();

// echo "Devolviendo 'El principito'...\n";
// $biblioteca->devolverLibro("El principito");

// echo "Listado final:\n";
// $biblioteca->listarLibros();
//
// <?php
require_once 'Libro.php';
require_once 'LibroDigital.php';

class Biblioteca {
    private $libros = [];

    public function agregarLibro(Prestable $libro) {
        $this->libros[] = $libro;
    }

    public function listarLibros() {
        foreach ($this->libros as $libro) {
            echo $libro->obtenerInformacion() . "\n";
            echo "Disponible: " . ($libro->estaDisponible() ? "Sí" : "No") . "\n\n";
            echo "<br> <br>";
        }
    }

    public function prestarLibro($titulo) {
        foreach ($this->libros as $libro) {
            if ($libro->getTitulo() === $titulo && $libro->estaDisponible()) {
                $libro->prestar();
                return true;
            }
        }
        return false;
    }

    public function devolverLibro($titulo) {
        foreach ($this->libros as $libro) {
            if ($libro->getTitulo() === $titulo && !$libro->estaDisponible()) {
                $libro->devolver();
                return true;
            }
        }
        return false;
    }
}

// Ejemplo de uso
$biblioteca = new Biblioteca();

$libro1 = new Libro("El principito", "Antoine de Saint-Exupéry", 1943);
$libro2 = new LibroDigital("Dune", "Frank Herbert", 1965, "EPUB", 3.2);

$biblioteca->agregarLibro($libro1);
$biblioteca->agregarLibro($libro2);
echo "Listado inicial de libros:\n <br>";
$biblioteca->listarLibros();

echo "Prestando 'El principito'...\n";
$biblioteca->prestarLibro("El principito");

echo "<br><br>Listado después de prestar:\n<br>";
$biblioteca->listarLibros();

echo "Devolviendo 'El principito'...\n<br><br>";
$biblioteca->devolverLibro("El principito");

echo "Listado final:\n<br><br>";
$biblioteca->listarLibros();
?>