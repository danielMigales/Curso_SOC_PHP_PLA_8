<?php

//recuperar y validar datos obligatorios, envio de sentencia insert a la bbdd
function altaPersona()
{
    global $nif, $nombre, $apellidos, $direccion, $telefono, $email, $errores, $conexionBanco;
    $sql = null;
    $tabla = 'personas';

    try {
        //recuperar nif
        if (!$nif = filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Introduzca un nif valido." . '<br>';
        }
        //recuperar nombre del input utilizando addslashes
        if (!$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Introduzca un nombre valido." . '<br>';
        }
        //ponerlo en minusculas
        $nombre = ucfirst(strtolower($nombre));
        //recuperar apellidos utilizando addslashes
        if (!$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Introduzca un apellido valido." . '<br>';
        }
        //ponerlo en minusculas
        $apellidos = ucfirst(strtolower($apellidos));
        //recuperar direccion utilizando addslashes
        if (!$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Introduzca una direccion valida." . '<br>';
        }
        //ponerlo en minusculas
        $direccion = ucfirst(strtolower($direccion));
        //recuperar telefono
        $telefono = $_POST['telefono'];
        //recuperar direccion email
        if (!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $errores .= 'Introduzca un email valido.' . '<br>';
        }
        //si $errores tiene algun mensaje lanza excepcion. 
        if ($errores != null) {
            throw new Exception($errores);
        }
        //En caso contrario inserta los datos en la bbdd
        if ($errores == null) {
            try {
                $sql = "INSERT INTO $tabla VALUES (NULL, '$nif', '$nombre', '$apellidos','$direccion', '$telefono', '$email', CURRENT_TIMESTAMP);";
                if (!mysqli_query($conexionBanco, $sql)) {
                    if ($conexionBanco->errno == 1062) {
                        //ESTO NO LO LLEGA A IMPRIMIR NUNCA. SIEMPRE SALE: Duplicate entry 'numero introducido' for key 'nif'
                        throw new Exception("El nif ya existe en la base de datos");
                    } else {
                        echo ($conexionBanco->error);
                    }
                }
                $errores .= 'Se ha insertado el registro en personas';
            } catch (Exception $e) {
                $errores .= $e->getMessage();
            }
        }
    } catch (Exception $e) {
        $errores = $e->getMessage();
    }
}
