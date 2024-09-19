Para usar el sistema que implementamos, en el fondo del codigo encontraremso la creacion del objeto sistema, de la clase SistemaGestion Estudiante, 
alli podremos crear un nuevo objeto de estudiante, como se ve claramente en los objetos estudiantes ya creados, 
al nuevo objeto tendremos que agregarle como primer parametro el id, siguiendo con la secuencia asignada anteriormente, seguido del nombre, la edad, la carrera que lleva el estudiante, 
se implementa la funcion agregarMateria que pertenece a la clase estudiante, se pueden agregar tantas materias como tenga el estudiante, 
por utlimo se agrega el nuevo objeto estudiante al objeto sistema  y se agrega con el nuevo objeto como parametro 
ejemplo:
$est4 = new Estudiante(4, "Jose Perez", 21, "Ingeniria Civil");
$est4->agregarMateria("Calculo", 92);
$est4->agregarMateria("Resistencia de los materiarles", 94);

$sistema->agregarEstudiante($est4);

el sistema mostrara los nombres de los estudiantes, los id, la carrera y el promedio individual, asi como el promedio general, el mejor estudiante, y nombre del estudiantes con mayor promedio asi como su informacion.
