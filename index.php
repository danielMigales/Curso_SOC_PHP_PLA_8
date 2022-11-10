<?php
//inicializar variables
$errores = null;

//inputs del formulario
$nif = $nombre = $apellidos = $direccion = $telefono = $email = null;

//conexion a la bbdd
require 'conexion.php';
//fichero con funcion de validacion e insert SQL
require 'altaPersona.php';
//fichero con funcion de consulta de todos los datos de la tabla personas de la BBDD
require 'consultaPersonas.php';

//ALTA
if (isset($_POST['alta'])) {
	try {
		//efecturar validacion de datos e insertar registro en BBDD
		altaPersona();
	} catch (Exception $e) {
		$errores = $e->getMessage();
	}
}

//MODIFICACION

//BAJA

//CONSULTA DE UNA PERSONA DE LA TABLA





?>

<html>

<head>
	<title>Banco</title>
	<meta charset='UTF-8'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
	<div class='container'>

		<form id='formulario' method='post' action='#'>

			<input type='hidden' id='idpersona' name='idpersona'>

			<!--añadida variable en los valores de los inputs-->

			<div class="row mb-3">
				<label for="nif" class="col-sm-2 col-form-label">NIF</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nif" name='nif' value='<?= $nif ?>'>
				</div>
			</div>

			<div class="row mb-3">
				<label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nombre" name="nombre" value='<?= $nombre ?>'>
				</div>
			</div>

			<div class="row mb-3">
				<label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="apellidos" name="apellidos" value='<?= $apellidos ?>'>
				</div>
			</div>

			<div class="row mb-3">
				<label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="direccion" name="direccion" value='<?= $direccion ?>'>
				</div>
			</div>

			<div class="row mb-3">
				<label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="telefono" name="telefono" value='<?= $telefono ?>'>
				</div>
			</div>

			<div class="row mb-3">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" name="email" value='<?= $email ?>'>
				</div>
			</div>

			<label class="col-sm-2 col-form-label"></label>
			<button type="submit" class="btn btn-success" id='alta' name='alta'>Alta</button>
			<button type="submit" class="btn btn-warning" id='modificacion' name='modificacion'>Modificación</button>
			<button type="submit" class="btn btn-danger" id='baja' name='baja'>Baja</button>
			<button type="reset" class="btn btn-success">Limpiar</button>

			<label class="col-sm-2 col-form-label"></label>
			<p class='mensajes'><?= $errores ?></p>

		</form><br><br>

		<table id='listapersonas' class="table table-striped">
			<tr data-id='idpersona'>
				<td>NIF</td>
				<td>Nombre</td>
				<td>Apellidos</td>
			</tr>

			<!--CONSULTA DE TODAS LAS PERSONAS-->
			<!--leer la base de datos y crear tabla-->
			<?= consultaPersonas(); ?>

		</table>
	</div>
	<form id='formconsulta' method='post' action='#'>
		<input type='hidden' id='consulta' name='consulta'>
	</form>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script type="text/javascript" src='scripts/script.js'></script>
</body>

</html>