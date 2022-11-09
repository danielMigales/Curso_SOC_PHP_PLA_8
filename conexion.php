<?php

$host = 'localhost';
$usuario = 'root';
$password = "";
$bbdd = 'banco';
$conexionBanco = mysqli_connect($host, $usuario, $password, $bbdd);

try {
    //host, usuario, password, base de datos
    if (!$conexionBanco) {
        throw new Exception("Error de conexion a la base de datos", 99);
    }
    mysqli_set_charset($conexionBanco, "utf8");
} catch (Exception $e) {
    $errores = $e->getMessage();
}
