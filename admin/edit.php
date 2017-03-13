<?php 
session_start();

require_once('config.php');
require_once('classesv2.php');

$GetPhoneQuery = "SELECT * FROM Telefonos WHERE idTelefonos ='" . $_GET["id"] . "'";
$GetPhoneResult = mysqli_query($conn, $GetPhoneQuery);
while($row=mysqli_fetch_array($GetPhoneResult)){
  $PhoneName = $row["NombreCompleto"];
}
$Telefono = new Telefono($PhoneName);
?>


<html>
<head>
	<title>EDITOR | bnds.cl</title>
  <meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="/js/bootstrap-typeahead.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/theme.min.css">
  <link href='https://fonts.googleapis.com/css?family=Titilium+Web' rel='stylesheet' type='text/css'>
  <style>
    body {
      font-family: 'Titilium Web', sans-serif;
    }
  </style>
</head>
<body>
    <!--Inicio Navbar-->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/index.php">bnds</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="/index.php">Inicio</a></li>
          <li><a href="/list.php">Equipos</a></li>
          <li><a href="/listSolicitud.php">Solicitudes</a></li>
          <li><a href="/add.php">Agregar equipo</a></li>
          <li><a href="/upload.php">Agregar imágen</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--Fin Navbar-->
<div class="container">
  <div class="row">
    <form action="submitEdit.php" method="POST" role="form">
      <legend>Editando el teléfono <?php echo $PhoneName ?></legend>
    
      <div class="form-group">
        <label for="">Marca</label>
        <input type="text" class="form-control" id="Marca" name="Marca" required="required" value="<?php echo $Telefono->Marca ?>">
      </div>
      <div class="form-group">
        <label for="">Modelo</label>
        <input type="text" class="form-control" id="Modelo" name="Modelo" required="required" value="<?php echo $Telefono->Modelo ?>">
      </div>
      <div class="form-group">
        <label for="">Variante</label>
        <input type="text" class="form-control" id="Variante" name="Variante" value="<?php echo $Telefono->Variante ?>">
      </div>
      <div class="form-group">
        <label for="">SLUG (Link sin "http://pisapapeles.net/") del review:</label>
        <input type="text" class="form-control" id="Review" name="Review" value="<?php echo $Telefono->LinkReview ?>">
      </div>
      <div class="form-group">
        <label>Bandas 2G:</label>
        <label class="checkbox-inline">
          <input type="checkbox" id="GSM1900" name="GSM1900" value="TRUE" <?php if ($Telefono->GSM1900 == "TRUE"){echo "checked";} ?>> 1900MHz.
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="GSM900" name="GSM900" value="TRUE" <?php if ($Telefono->GSM900 == "TRUE"){echo "checked";} ?>> 900MHz.
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="GSM850" name="GSM850" value="TRUE" <?php if ($Telefono->GSM850 == "TRUE"){echo "checked";} ?>> 850MHz.
        </label>
      </div>
      <div class="form-group">
        <label>Bandas 3G:</label>
        <label class="checkbox-inline">
          <input type="checkbox" id="UMTS1900" name="UMTS1900" value="TRUE" <?php if ($Telefono->UMTS1900 == "TRUE"){echo "checked";} ?>> 1900MHz.
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="UMTS900" name="UMTS900" value="TRUE" <?php if ($Telefono->UMTS900 == "TRUE"){echo "checked";} ?>> 900MHz.
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="UMTS850" name="UMTS850" value="TRUE" <?php if ($Telefono->UMTS850 == "TRUE"){echo "checked";} ?>> 850MHz.
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="UMTSAWS" name="UMTSAWS" value="TRUE" <?php if ($Telefono->UMTSAWS == "TRUE"){echo "checked";} ?>> 1700/2100MHz. (AWS)
        </label>
      </div>
      <div class="form-group">
        <label>Bandas 4G:</label>
        <label class="checkbox-inline">
          <input type="checkbox" id="LTE2600" name="LTE2600" value="TRUE" <?php if ($Telefono->LTE2600 == "TRUE"){echo "checked";} ?>> 2600MHz.
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="LTE700" name="LTE700" value="TRUE" <?php if ($Telefono->LTE700 == "TRUE"){echo "checked";} ?>> 700MHz.
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="LTEAWS" name="LTEAWS" value="TRUE" <?php if ($Telefono->LTEAWS == "TRUE"){echo "checked";} ?>> 1700/2100MHz. (AWS)
        </label>
      </div>
      <div class="form-group">
        <label>Otros:</label>
        <label class="checkbox-inline">
          <input type="checkbox" id="LTEA" name="LTEA" value="TRUE" <?php if ($Telefono->LTEA == "1"){echo "checked";} ?>> LTE-Advanced
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="HDVoice" name="HDVoice" value="TRUE" <?php if ($Telefono->HDVoice == "1"){echo "checked";} ?>> Voz HD
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" id="SAE" name="SAE" value="TRUE" <?php if ($Telefono->SAE == "1"){echo "checked";} ?>> Sistema de Alertas de Emergencia (SAE)
        </label>
        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">

      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</body>
</html>