<?php 

if (isset($_POST["Marca"])){

}
else {
	header('Location: add.php');
	die();
};
if (isset($_POST["Modelo"])){

}
else {
	header('Location: add.php');
	die();
};
if (isset($_POST["Variante"])){

}
else {
	header('Location: add.php');
	die();
};

require_once('classesv2.php');

$telefono = new InputPhone;
$telefono->GetPOST();
$telefono->GetDuplicate($telefono->NombreCompleto);
$telefono->InsertTelefono();
$telefono->InsertBandas();

?>

<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
<p>Marca: <?php echo $telefono->Marca ?></p>
<p>Modelo: <?php echo $telefono->Modelo ?></p>
<p>Variante: <?php echo $telefono->Variante ?></p>
<p>Nombre Completo: <?php echo $telefono->NombreCompleto ?></p>
<p>----Bandas 2G:----</p>
<p>1900MHz.: <?php echo $telefono->GSM1900 ?></p>
<p>900MHz.: <?php echo $telefono->GSM900 ?></p>
<p>850MHz.: <?php echo $telefono->GSM850 ?></p>
<p>----Bandas 3G:----</p>
<p>1900MHz.: <?php echo $telefono->UMTS1900 ?></p>
<p>900MHz.: <?php echo $telefono->UMTS900 ?></p>
<p>850MHz.: <?php echo $telefono->UMTS850 ?></p>
<p>AWS: <?php echo $telefono->UMTSAWS ?></p>
<p>----Bandas 4G:----</p>
<p>2600MHz.: <?php echo $telefono->LTE2600 ?></p>
<p>700MHz.: <?php echo $telefono->LTE700 ?></p>
<p>AWS: <?php echo $telefono->LTEAWS ?></p>
<p>------Otros:------</p>
<p>LTE-Advanced: <?php echo $telefono->LTEA ?></p>
<p>Voz HD: <?php echo $telefono->HDVoice ?></p>
<p>Sistema de Alertas de Emergencia (SAE): <?php echo $telefono->SAE ?></p>
<p>----RESULTADOS----</p>
<p>Coincidencia en la base de datos: <?php echo $telefono->DuplicateMatch ?></p>
<p>Estado del agregador de teléfono: <?php echo $telefono->InsertTelefonoResult ?></p>
<p>Respuesta del agregador de teléfono: <?php echo $telefono->InsertTelefonoResponse ?></p>
<p>ID del teléfono agregado (Si se realizó): <?php echo $telefono->InsertTelefonoID ?></p>
<p>Estado del agregador de bandas: <?php echo $telefono->InsertBandasResult ?></p>
<p>Respuesta del agregador de bandas: <?php echo $telefono->InsertBandasResponse ?></p>
<p>----SISTEMA FINALIZADO. SI HAY ALGUN ERROR, AVISAR DE INMEDIATO----</p>
<p><a href="add.php">Volver al agregador</p>
</body>
</html>