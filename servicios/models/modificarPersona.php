<?php

//recuperar y validar datos de los inputs, envio de sentencia update a la bbd
function modificarPersona()
{
    global $nif, $nombre, $apellidos, $direccion, $telefono, $email, $errores, $conexionBanco, $id;
    $sql = null;
    $tabla = 'personas';

    try {
        //PERFECCIONAR ESTE APARTADO DEL ID    
        
        //recuperar y validar de el campo id 
        if (!$id = filter_input(INPUT_POST, 'idpersona')) {
            $errores .= "id no puede estar vacio." . '<br>';
        }
        if (!is_numeric($id)) {
            $errores .= "id ha de ser numerico." . '<br>';
        }
        if ($id <= 0) {
            $errores .= "id ha de ser un valor positivo." . '<br>';
        }



        //recuperar nif
        if (!$nif = filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Nif no puede estar vacio." . '<br>';
        }
        //recuperar nombre del input utilizando addslashes
        if (!$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Nombre no puede estar vacio." . '<br>';
        }
        //ponerlo en minusculas
        $nombre = ucfirst(strtolower($nombre));
        //recuperar apellidos utilizando addslashes
        if (!$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Apellido no puede estar vacio." . '<br>';
        }
        //ponerlo en minusculas
        $apellidos = ucfirst(strtolower($apellidos));
        //recuperar direccion utilizando addslashes
        if (!$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Direccion no puede estar vacio." . '<br>';
        }
        //ponerlo en minusculas
        $direccion = ucfirst(strtolower($direccion));
        //recuperar telefono
        $telefono = $_POST['telefono'];
        //recuperar direccion email
        if (!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $errores .= 'Email no puede estar vacio.' . '<br>';
        }
        //si $errores tiene algun mensaje lanza excepcion. 
        if ($errores != null) {
            throw new Exception($errores);
        }

        //si no hay errores en ningun campo se lanza la query de update
        if ($errores == null) {
            //sentencia con todos los valores del formulario
            $sql = "UPDATE $tabla SET nif ='$nif', nombre='$nombre', apellidos='$apellidos', direccion='$direccion', telefono='$telefono', email='$email' WHERE idpersona = $id;";
            mysqli_query($conexionBanco, $sql) or die(mysqli_error($conexionBanco));

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
