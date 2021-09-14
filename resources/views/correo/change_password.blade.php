<!--
* editar.blade.php
* Ruta:              papelnotarial/resources/views/correo/plantilla_correo.blade.php
* Fecha Creación:    Feb/2019
*
* Plantilla para enviar correos
*
* @author           Maria Monica Gutierrez Torres <monica.gutierrez@turrisystem.com>
* @copyright        2019 Turrisystem Ltda.
* @version          2019
*
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>correo</title>
		<style type="text/css">
			table, th, td, tr{
				border: 1px solid black;
  				border-collapse: collapse;
			}
		</style>
	</head> 

	<body class="body">
		<div style="width: 100%">

			<br><br>Estimado(a) {{$dataUser['usuario']}}
            <br><br>
            El cambio de tu contraseña para el acceso a {{ session('nombre_largo')}} - CNE se ha realizado satisfactoriamente.
            <br><br>
            <i>Nueva Contraseña: </i>{{$dataUser['password']}}
            <br><br>
            Puedes cambiar tu contraseña en cualquier momento accediendo a tu cuenta.
            <br>
            Te recomendamos cambiar tu contraseña por una que recuerdes fácilmente.
            <br><br><br>

		</div>
	</body>
</html>
