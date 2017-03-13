<?php 
session_start();

if ($_GET["fromfile"] == "TRUE"){

	$id = $_GET["id"];

	include('config.php');

	$query = "DELETE FROM `Solicitudes` WHERE `idSolicitudes` = " . $id;

	$result = mysqli_query($conn, $query);

	if (!$result) {
		$_SESSION["DelSolRes"] = "ERROR: NO SE HA ELIMINADO LA SOLICITUD";
		header('Location:/listSolicitud.php');
	}
	else {
		$_SESSION["DelSolRes"] = "LA SOLICITUD SE HA ELIMINADO CON ÉXITO";
		header('Location:/listSolicitud.php');
	}
}

else {
	echo "<p>EL ARCHIVO NO HA SIDO ACCEDIDO DESDE EL LISTADOR. NO SE HA REALIZADO NADA.</p>";
}

?>
