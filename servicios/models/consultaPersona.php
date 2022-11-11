<?php

//variable de sesion para guardar el id de la persona seleccionada y poder pasarlo a todo el documento
session_start();
$_SESSION["idpersona"];

//validar campos de la tabla listado de personas y envio de consulta a la bbdd
function consultaPersona()
{
    global  $nif, $nombre, $apellidos, $direccion, $telefono, $email, $errores, $conexionBanco;
    $sql = null;
    $tabla = 'personas';

    try {
        //recuperar y validar de el campo id 
        if (!$id = filter_input(INPUT_POST, 'consulta')) {
            $errores .= "El id de la persona es incorrecto." . '<br>';
        }
        if (!is_numeric($id)) {
            $errores .= "Error en la seleccion de la persona." . '<br>';
        }
        if ($id <= 0) {
            $errores .= "Error en la seleccion de la persona." . '<br>';
        }
        //si $errores tiene algun mensaje lanza excepcion. 
        if ($errores != null) {
            throw new Exception($errores);
        }
    } catch (Exception $e) {
        $errores = $e->getMessage();
    }

    //sentencia con el resultado filtrado por id
    $sql = "SELECT * FROM $tabla WHERE idpersona = $id";
    $result = mysqli_query($conexionBanco, $sql) or die(mysqli_error($conexionBanco));

    //array resultados
    $persona = mysqli_fetch_assoc($result);

    //pasar datos a inputs del formulario html
    $id = $persona['idpersona'];
    $nif = $persona['nif'];
    $nombre = $persona['nombre'];
    $apellidos = $persona['apellidos'];
    $direccion = addslashes($persona['direccion']);
    $telefono = $persona['telefono'];
    $email = $persona['email'];

    //asignar el valor del id a la sesion
    $_SESSION["idpersona"] = $id;
}
