<?php

//recuperar y validar datos de los inputs, envio de sentencia update a la bbd
function modificarPersona()
{
    global $idpersona, $nif, $nombre, $apellidos, $direccion, $telefono, $email, $errores, $conexionBanco;
    $sql = null;
    $tabla = 'personas';

    try {
        //lamada al metodo validar ID
        validarIDpersonaSesion();

        //llamada al metodo validar formulario
        validarFormulario();

         //comprobar que el id exista enla base de datos
         $sql = "SELECT * FROM $tabla WHERE idpersona = $idpersona;";
         $result = mysqli_query($conexionBanco, $sql) or die(mysqli_error($conexionBanco));
 
         if (mysqli_num_rows($result) <= 0) {
             $errores .= 'No se encuentra persona con ese ID';
         }
 
        //si $errores tiene algun mensaje lanza excepcion. 
        if ($errores != null) {
            throw new Exception($errores);
        }

        //si no hay errores en ningun campo se lanza la query de update
        if ($errores == null) {
            //sentencia con todos los valores del formulario
            $sql = "UPDATE $tabla SET nif ='$nif', nombre='$nombre', apellidos='$apellidos', direccion='$direccion', telefono='$telefono', email='$email' WHERE idpersona = $idpersona;";
            mysqli_query($conexionBanco, $sql) or die(mysqli_error($conexionBanco));

            //verificacion si se han modificado datos
            if ($conexionBanco->affected_rows == 0) {
                $errores .= 'No se han modificado datos.';
            } else {
                $errores .= 'Modificacion efectuada';
            }
        }
    } catch (Exception $e) {
        $errores = $e->getMessage();
    }
}
