<?php

//validar campos de la tabla listado de personas y envio de consulta a la bbdd
function consultaPersona()
{
    global  $idpersona, $nif, $nombre, $apellidos, $direccion, $telefono, $email, $conexionBanco;
    $sql = null;
    $tabla = 'personas';

    //llamada a la funcion que valida el campo id
    validarIdpersona();

    //sentencia con el resultado filtrado por id
    $sql = "SELECT * FROM $tabla WHERE idpersona = $idpersona";
    $result = mysqli_query($conexionBanco, $sql) or die(mysqli_error($conexionBanco));

    //array resultados
    $persona = mysqli_fetch_assoc($result);

    //pasar datos a inputs del formulario html
    $nif = $persona['nif'];
    $nombre = $persona['nombre'];
    $apellidos = $persona['apellidos'];
    $direccion = addslashes($persona['direccion']);
    $telefono = $persona['telefono'];
    $email = $persona['email'];

    //variable de sesion para guardar el id de la persona seleccionada y poder pasarlo a todo el documento
    $_SESSION["idpersona"] = $idpersona;
}
