<?php

//recuperar y validar datos obligatorios, envio de sentencia insert a la bbdd
function altaPersona()
{
    global $nif, $nombre, $apellidos, $direccion, $telefono, $email, $errores, $conexionBanco;
    $sql = null;
    $tabla = 'personas';

    //llamada a la funcion que valida los inputs del formulario
    validarFormulario();

    //Si no ha habido ningun error en la validacion inserta los datos en la bbdd
    if ($errores == null) {
        try {
            //sentencia de insert sql
            $sql = "INSERT INTO $tabla VALUES (NULL, '$nif', '$nombre', '$apellidos','$direccion', '$telefono', '$email', CURRENT_TIMESTAMP);";
            //comprobacion de errores msqli_query

            if (!mysqli_query($conexionBanco, $sql)) {
                //ESTO NO LO LLEGA A IMPRIMIR NUNCA. SIEMPRE SALE: Duplicate entry 'numero introducido' for key 'nif'
                //dejo el bloque if activo pero no funciona, el que lanza el error personalizado es la comparacion que hay en el catch
                if ($conexionBanco->errno == 1062) {
                    throw new Exception("El nif ya existe en la base de datos");
                } else {
                    echo ($conexionBanco->error);
                }
            }
            //si no hay error inserta la linea en la bbdd y aparece el mensaje de registro correcto
            $errores .= 'Se ha insertado el registro en personas';
        } catch (Exception $e) {
            $errores .= $e->getMessage() . '<br>';
            //captura la excepcion y si es el 1062 lanza el mensaje
            $codigoError = $e->getCode();
            if ($codigoError == 1062) {
                $errores .= "El nif ya existe en la base de datos";
            }
        }
    }
}
