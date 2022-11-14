<?php

//funcion para recuperar los valores de los formularios
function validarFormulario()
{
    //variables globales
    global $nif, $nombre, $apellidos, $direccion, $telefono, $email, $errores;

    try {
        //recuperar nif
        if (!$nif = filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Introduzca un nif valido." . '<br>';
        }
        //recuperar nombre del input utilizando addslashes
        if (!$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Introduzca un nombre valido." . '<br>';
        }
        //recuperar apellidos utilizando addslashes
        if (!$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Introduzca un apellido valido." . '<br>';
        }
        //recuperar direccion utilizando addslashes
        if (!$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_ADD_SLASHES)) {
            $errores .= "Introduzca una direccion valida." . '<br>';
        }
        //recuperar telefono
        $telefono = $_POST['telefono'];
        //recuperar direccion email
        if (!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $errores .= 'Introduzca un email valido.' . '<br>';
        }
        //ponerlo en minusculas
        $nombre = ucfirst(strtolower($nombre));
        $apellidos = ucfirst(strtolower($apellidos));
        $direccion = ucfirst(strtolower($direccion));
        $email = strtolower($email);
        //si $errores tiene algun mensaje lanza excepcion. 
        if ($errores != null) {
            throw new Exception($errores);
        }
    } catch (Exception $e) {
        $errores = $e->getMessage();
    }
}
