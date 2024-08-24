<?php
function obtenerLibros(){
    $lista_libros=[
        [
            'nombre_del_libro'=>'Cien años de soledad',
            'autor'=> 'Gabriel García Marquez',
            'año'=> '1967',
            'genero'=>'Realismo magico',
            'descripcion'=> 'Nos narra la historia de la familia Buendia a lo largo de siete
            generaciones en el pueblo ficticio de Macondo, abordando temas como la soledad,
            el destino y el realismo magico, es un estilo que mezcla la realidad con elementos fantasticos.'
        ],
        [
            'nombre_del_libro'=>'Tu sola en mi vida',
            'autor'=>'Isabel Allende',
            'año'=>'2006',
            'genero'=>'Novela contemporanea',
            'descripcion'=> 'Una novela contemporánea que explora las complejidades del amor y la pérdida.
            A través de la protagonista, Isabel Allende nos lleva a un viaje emocional donde las 
            fronteras entre la realidad y los recuerdos se desdibujan, creando una narrativa poética y profundamente conmovedora.'
        ],
        [
            'nombre_del_libro'=>'El principito',
            'autor'=>'Antonie de Saint_Exupery',
            'año'=>'1943',
            'genero'=>'Fabula, Literatura infantil',
            'descripcion'=> 'Clásico de la literatura infantil que, a través de la historia de un joven príncipe de otro planeta,
            explora temas profundos como el amor, la amistad, y el sentido de la vida. '
        ],
        [
            'nombre_del_libro'=>"El jardin secreto",
            'autor'=>'Frances Hodgson Bunett',
            'año'=>'1911',
            'genero'=>'Literatura infantil, Clasico',
            'descripcion'=> 'Novela clásica que sigue la vida de Mary Lennox, 
            una niña huérfana que es enviada a vivir con su tío en una gran mansión en Inglaterra.
            A través del descubrimiento de un jardín oculto, la novela aborda temas de redención,
            amistad, y el poder curativo de la naturaleza.'
        ],
        [
            'nombre_del_libro'=>'El Hobbit',
            'autor'=>'J.R.R. Tolkien',
            'año'=>'1937',
            'genero'=>'Fantasia',
            'descripcion'=> 'Novela de fantasía que narra las aventuras de Bilbo Bolsón,
            un hobbit que es llevado a un viaje épico para ayudar a un grupo de enanos a recuperar su reino
            y tesoro de las garras del dragón Smaug.
            Precuela de "El Señor de los Anillos",
            esta historia está llena de criaturas mágicas, batallas y la lucha entre el bien y el mal.'
        ]
        ];
return $lista_libros;
}

// function mostrarDetallesLibro($libro){
//     if (!is_array($libro)){
//     return $libro;
//     }else{echo "El valor de ingreso no es un arreglo"}
// }
function mostrarDetallesLibro($libro) {
    if (!is_array($libro) || isset($libro['nombre_del_libro'], $libro['autor'], $libro['año'], $libro['genero'], $libro['descripcion'])) {
        
        $html = '<div class="libro-detalle">';
        $html .= '<h2>' . htmlspecialchars($libro['nombre_del_libro']) . '</h2>';
        $html .= '<p> Autor:' . htmlspecialchars($libro['autor']) . '</p>';
        $html .= '<p> Año:' . htmlspecialchars($libro['año']) . '</p>';
        $html .= '<p> Género:' . htmlspecialchars($libro['genero']) .'</p>';
        $html .= '<p> Descripcion:' . htmlspecialchars($libro['descripcion']).'</p>';
        $html .= '</div>';
        return $html;
    } else {
        return '<p>Datos del libro no válidos.</p>';
    }
}


?>