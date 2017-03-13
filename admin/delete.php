<?php 

if ($_GET["fromfile"] == "TRUE"){

	$id = $_GET["id"];
	echo "<p>ID ha sido seteada: " . $id . "</p>";

	include('config.php');
	echo "<p>config.php incluído.</p>";

	$queryB = "DELETE FROM `Telefonos_Bandas` WHERE `idTelefonos` = " . $id;

	$queryT = "DELETE FROM `Telefonos` WHERE `idTelefonos` = " . $id;

	$resultB = mysqli_query($conn, $queryB);
	echo "<p>Query de bandas realizado<p>";

	if (!$resultB) {
		echo "<p>ERROR: NO SE HAN ELIMINADO LAS BANDAS DEL TELÉFONO</p>";
	}
	else {
		echo "<p>LAS BANDAS DEL TELEFONO HAN SIDO ELIMINADAS</p>";
	}

	$resultT = mysqli_query($conn, $queryT);
	echo "<p>Query de teléfono realizado<p>";

	if (!$resultT) {
		echo "<p>ERROR: NO SE HA ELIMINADO EL TELÉFONO</p>";
	}
	else {
		echo "<p>EL TELÉFONO HA SIDO ELIMINADO</p>";
	}
}
else {
	echo "<p>EL ARCHIVO NO HA SIDO ACCEDIDO DESDE EL LISTADOR. NO SE HA REALIZADO NADA.</p>";
}

?>
<p><a href="/list.php">VOLVER AL LISTADO</a></p>