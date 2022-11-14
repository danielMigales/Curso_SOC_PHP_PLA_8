<?php

function bajaPersona()
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

            $sql = "DELETE FROM $tabla WHERE idpersona = $idpersona;";
            mysqli_query($conexionBanco, $sql) or die(mysqli_error($conexionBanco));

            //este codigo de error tampoco funciona
            if ($conexionBanco->errno == 1451) {
                throw new Exception("Persona con cuentas asociadas no se puede borrar", 20);
            }

            if ($conexionBanco->affected_rows == 0) {
                $errores .= 'No se han modificado datos.';
            } else {
                $errores .= 'Borrado efectuado';
                //limpiado de inputs
                $nif = $nombre = $apellidos = $direccion = $telefono = $email = null;
            }
        }
    } catch (Exception $e) {
        $errores = $e->getMessage() . '<br>';
        //captura la excepcion y si es el 1451 lanza el mensaje
        $codigoError = $e->getCode();
        if ($codigoError == 1451) {
            $errores .= "Persona con cuentas asociadas no se puede borrar.";
        }
    }
}
