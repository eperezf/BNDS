<?php 
session_start();
?>
<html>
<head>
</head>
<body>
	<?php 
	if ($_SESSION["UploadResult"] == "TRUE"){
		echo "<p><h2>FOTOS SUBIDAS CON ÉXITO</h2></p>";
		$_SESSION["UploadResult"] = "FALSE";
	}
	 ?>
	<p><h1>SUBIR FOTOS DE TELEFONOS</h1></p>
	<p><h4>El nombre debe ser "MarcaModelo.png" sin comillas. ES SENSIBLE A MAYUSCULAS Y MINUSCULAS! OJO! POR FAVOR REVISAR BIEN! DEBE SER DE FORMATO PNG!!!</h4></p>
	<p>Se puede subir más de un archivo a la vez</p>
	<form method="POST" enctype="multipart/form-data" action="http://static.bnds.cl/img/telefonos/subir.php" >
		<input type="file" name="images[]" id="images" multiple >
		<input type="submit" value="Submit">
	</form>
</body>
</html>