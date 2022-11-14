<?php

//funcion para validar el campo id del formulario oculto
function validarIdpersona()
{
    global $errores, $idpersona;

    try {
        //recuperar y validar de el campo id . Lo obtiene del campo oculto consulta
        if (!$idpersona = filter_input(INPUT_POST, 'consulta')) {
            $errores .= "El id de la persona es incorrecto." . '<br>';
        }
        if (!is_numeric($idpersona)) {
            $errores .= "Error en la seleccion de la persona." . '<br>';
        }
        if ($idpersona <= 0) {
            $errores .= "Error en la seleccion de la persona." . '<br>';
        }
        //si $errores tiene algun mensaje lanza excepcion. 
        if ($errores != null) {
            throw new Exception($errores);
        }
    } catch (Exception $e) {
        $errores = $e->getMessage();
    }
}
