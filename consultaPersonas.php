<?php

function consultaPersonas()
{
    $tabla = 'personas';
    global $conexionBanco;

    //sentencia con el resultado ordenado por nombre
    $sql = "SELECT * FROM $tabla ORDER BY nombre";

    //objeto con los resultados
    $result = mysqli_query($conexionBanco, $sql) or die(mysqli_error($conexionBanco));

    //array resultados
    $filas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //crear tabla   
    foreach ($filas as $indice => $valores) {
        echo "<tr data-id=$valores[idpersona]><td>$valores[nif]</td><td>$valores[nombre]</td><td>$valores[apellidos]</td></tr>";
    }
}
