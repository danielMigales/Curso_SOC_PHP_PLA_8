<?php

//recuperar y validar de el campo id. Se obtiene de la variable de sesion
function validarIDpersonaSesion()
{
    global $idpersona, $errores;

    try {
        $idpersona = $_SESSION['idpersona'];
        //validacion que el id sea numero y mayor que 0 o no este vacio
        if (!is_numeric($idpersona)) {
            $errores .= "id ha de ser numerico." . '<br>';
        }
        if ($idpersona <= 0) {
            $errores .= "id ha de ser mayor a 0." . '<br>';
        }
        if (empty($idpersona)) {
            $errores .= "id no puede estar vacio" . '<br>';
        }
    } catch (Exception $e) {
        $errores = $e->getMessage();
    }
}
