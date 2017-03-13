<?php 
include('config.php');
$queryCount = "SELECT * FROM `MOTD`";
if ($queryCountResult = mysqli_query($conn, $queryCount)){
	$Count = mysqli_num_rows($queryCountResult);
}
$MOTD = rand(2, $Count);

$QueryMOTD = "SELECT * FROM `MOTD` WHERE `idMOTD` = $MOTD";
$ResultMOTD = mysqli_query($conn, $QueryMOTD);
while ($row = mysqli_fetch_array($ResultMOTD)){
	$Message = $row["Mensaje"];
	$id = $row["idMOTD"];
}

?>

<html>
<head>
	<title>ADMINISTRACIÓN | bnds.cl</title>
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
	        <li><a href="index.php">Inicio</a></li>
	        <li><a href="list.php">Equipos</a></li>
	        <li><a href="listSolicitud.php">Solicitudes</a></li>
	        <li><a href="add.php">Agregar equipo</a></li>
	        <li><a href="upload.php">Agregar imágen</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<!--Fin Navbar-->
	<div class="container">
<p><h1>INDEX ADMINISTRACIÓN BNDS</h1></p>
<p><h4>Por favor selecciona una de las opciones de arriba</h4></p>
<div class="well"><?php echo $Message ?></div>
</div>
</body>
</html>