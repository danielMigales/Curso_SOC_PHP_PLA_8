<?php

//funcion que lee la tabla personas de la bbdd y la imprime en una tabla html en el documento
function consultaPersonas()
{
    $tabla = 'personas';
    global $conexionBanco, $errores, $tablaHTML;

    //sentencia con el resultado ordenado por nombre
    $sql = "SELECT * FROM $tabla ORDER BY nombre";

    //objeto con los resultados
    $result = mysqli_query($conexionBanco, $sql) or die(mysqli_error($conexionBanco));

    //en caso de que la tabla este vacia aparece en el mensaje que no hay datos
    if (mysqli_num_rows($result) == 0) {
        $errores .= 'No hay datos en la tabla';
    }

    //array resultados
    $filas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //crear tabla   
    foreach ($filas as $indice => $valores) {
        $tablaHTML .= "<tr data-id=$valores[idpersona]><td>$valores[nif]</td><td>$valores[nombre]</td><td>$valores[apellidos]</td></tr>";
    }
}
