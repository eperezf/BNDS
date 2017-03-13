<?php 

if (isset($_POST["Marca"])){

}
else {
	header('Location: list.php');
	die();
};
if (isset($_POST["Modelo"])){

}
else {
	header('Location: list.php');
	die();
};
if (isset($_POST["Variante"])){

}
else {
	header('Location: list.php');
	die();
};

include('config.php');
require_once('classesv2.php');
$telefono = new EditPhone;
$telefono->GetOldData($_POST["id"]);
$telefono->CreateUpdateQuery();
$telefono->DoUpdateQuery();
$telefono->BandsUpdateProcess();


?>

<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
<table border="1">
	<tr>
		<th>Ítem</th>
		<th>Valor antiguo</th>
		<th>Valor nuevo</th>
	</tr>
	<tr>
		<td>Marca</td>
		<td><?php echo $telefono->MarcaOld ?></td>
		<td><?php echo $telefono->Marca ?></td>
	</tr>
	<tr>
		<td>Modelo</td>
		<td><?php echo $telefono->ModeloOld ?></td>
		<td><?php echo $telefono->Modelo ?></td>
	</tr>
	<tr>
		<td>Variante</td>
		<td><?php echo $telefono->VarianteOld ?></td>
		<td><?php echo $telefono->Variante ?></td>
	</tr>
	<tr>
		<td>Nombre Completo</td>
		<td><?php echo $telefono->NombreCompletoOld ?></td>
		<td><?php echo $telefono->NombreCompleto ?></td>
	</tr>
	<tr>
		<td>1900Mhz. (GSM)</td>
		<td><?php echo $telefono->GSM1900Old ?></td>
		<td><?php echo $telefono->GSM1900 ?></td>
	</tr>
	<tr>
		<td>900Mhz. (GSM)</td>
		<td><?php echo $telefono->GSM900Old ?></td>
		<td><?php echo $telefono->GSM900 ?></td>
	</tr>
	<tr>
		<td>850Mhz. (GSM)</td>
		<td><?php echo $telefono->GSM850Old ?></td>
		<td><?php echo $telefono->GSM850 ?></td>
	</tr>
	<tr>
		<td>1900Mhz. (UMTS)</td>
		<td><?php echo $telefono->UMTS1900Old ?></td>
		<td><?php echo $telefono->UMTS1900 ?></td>
	</tr>
	<tr>
		<td>900Mhz. (UMTS)</td>
		<td><?php echo $telefono->UMTS900Old ?></td>
		<td><?php echo $telefono->UMTS900 ?></td>
	</tr>
	<tr>
		<td>850Mhz. (UMTS)</td>
		<td><?php echo $telefono->UMTS850Old ?></td>
		<td><?php echo $telefono->UMTS850 ?></td>
	</tr>
	<tr>
		<td>AWS (UMTS)</td>
		<td><?php echo $telefono->UMTSAWSOld ?></td>
		<td><?php echo $telefono->UMTSAWS ?></td>
	</tr>
	<tr>
		<td>2600Mhz. (LTE)</td>
		<td><?php echo $telefono->LTE2600Old ?></td>
		<td><?php echo $telefono->LTE2600 ?></td>
	</tr>
	<tr>
		<td>700Mhz. (LTE)</td>
		<td><?php echo $telefono->LTE700Old ?></td>
		<td><?php echo $telefono->LTE700 ?></td>
	</tr>
	<tr>
		<td>AWS (LTE)</td>
		<td><?php echo $telefono->LTEAWSOld ?></td>
		<td><?php echo $telefono->LTEAWS ?></td>
	</tr>
	<tr>
		<td>LTE-Advanced</td>
		<td><?php echo $telefono->LTEAOld ?></td>
		<td><?php echo $telefono->LTEA ?></td>
	</tr>
	<tr>
		<td>Voz HD</td>
		<td><?php echo $telefono->HDVoiceOld ?></td>
		<td><?php echo $telefono->HDVoice ?></td>
	</tr>
	<tr>
		<td>SAE</td>
		<td><?php echo $telefono->SAEOld ?></td>
		<td><?php echo $telefono->SAE ?></td>
	</tr>
</table>

<p>----RESULTADOS----</p>
<p>Query generado: <?php echo $telefono->DataUpdateQuery ?></p>
<p>Estado de la edición de datos normales: <?php echo $telefono->DataUpdateResult ?></p>
<p>Resultado de la edición de datos normales: <?php echo $telefono->DataUpdateResponse ?></p>
<p>Errores: <?php echo mysqli_error($conn); ?>
<p>----SISTEMA FINALIZADO. SI HAY ALGUN ERROR, AVISAR DE INMEDIATO----</p>
<p><a href="list.php">Volver a la lista</a></p>
</body>
</html>