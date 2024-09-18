<?php
// 1. Crear un arreglo de 10 nombres de ciudades
$ciudades = ["Nueva York", "Tokio", "Londres", "París", "Sídney", "Río de Janeiro", "Moscú", "Berlín", "Ciudad del Cabo", "Toronto"];

// 2. Imprimir el arreglo original
echo "<br> Ciudades originales:\n";
print_r($ciudades);

// 3. Agregar 2 ciudades más al final del arreglo
array_push($ciudades, "Dubái", "Singapur");

// 4. Eliminar la tercera ciudad del arreglo
array_splice($ciudades, 2, 1);

// 5. Insertar una nueva ciudad en la quinta posición
array_splice($ciudades, 4, 0, "Mumbai");

// 6. Imprimir el arreglo modificado
echo "\n<br> Ciudades modificadas:\n";
print_r($ciudades);

// 7. Crear una función que imprima las ciudades en orden alfabético
function imprimirCiudadesOrdenadas($arr)
{
    $ordenado = $arr;
    sort($ordenado);
    echo "<br> Ciudades en orden alfabético:\n";
    foreach ($ordenado as $ciudad) {
        echo "- $ciudad\n";
    }
    return $ordenado;
}

// 8. Llamar a la función
// echo "<br> imprimiendo ciudades ordenadas";
// imprimirCiudadesOrdenadas($ciudades);

// TAREA: Crea una función que cuente y retorne el número de ciudades que comienzan con una letra específica
// Ejemplo de uso: contarCiudadesPorInicial($ciudades, 'S') debería retornar 1 (Singapur)
// Tu código aquí

//asignamos el valor de retorno a una variable
$ciudades_ordenadas = imprimirCiudadesOrdenadas($ciudades);
// print_r ($ciudades_ordenadas);
echo "<br><br>";
function contar_ciudades($ciudades_ordenadas, $letra)
{
    $cantidad_ciudades = 0;
    $nombres_ciudades = [];
    for ($i = 0; $i < count($ciudades_ordenadas); $i++) {

        // echo "<br>contendio del aray dentro del for<br>";
        // print_r ($ciudades_ordenadas[$i]);
        // echo "<br> valor de la letra de entrada: ". $letra."<br>";

        if (substr($ciudades_ordenadas[$i], 0, 1) == $letra) {
            // echo "<br>dentro del if <br>";
            $cantidad_ciudades++;
            array_push($nombres_ciudades, $ciudades_ordenadas[$i]);
            // echo $cantidad_ciudades."estamos aqui";
        }

        $imprimir_array = implode(', ', $nombres_ciudades);
    }

    echo "cantidad de ciudades: " . $cantidad_ciudades . "<br>";
    echo "nombre de las ciudades: ";
    print_r($imprimir_array);
}
//hacer el llamado de la funcion
//ojo con el parametro entre comillas simples y dobles, afecta el resultado
echo contar_ciudades($ciudades_ordenadas, 'S');
