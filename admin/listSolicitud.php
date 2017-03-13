<?php 
session_start();

require_once('config.php');
$query = "SELECT * FROM `Solicitudes`";
$result = mysqli_query($conn, $query);

?>
<html>
<head>
	<title>SOLICITUDES | bnds.cl</title>
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
	        <li class="active"><a href="#">Solicitudes</a></li>
	        <li><a href="add.php">Agregar equipo</a></li>
	        <li><a href="upload.php">Agregar imágen</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<!--Fin Navbar-->
	<div class="container">
		<?php if (!isset($_SESSION["DelSolRes"])){$_SESSION["DelSolRes"] = "";}; if ($_SESSION["DelSolRes"] != ""):?>
    <div class="row">  
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION["DelSolRes"]; $_SESSION["DelSolRes"] = "" ?>
      </div>
    </div>
  <?php endif; ?>
		<div class="row">
			<legend>Lista de solicitudes</legend>
		</div>
		<div class="row">
			<table class="table table-striped">
				<tr>
					<td>Marca</td>
					<td>Modelo</td>
					<td>Variante</td>
					<td>Acción</td>
				</tr>
				<?php while ($row = mysqli_fetch_array($result)): ?>
				<?php
					$idSolicitudes = $row["idSolicitudes"];
					$Marca = $row["Marca"];
					$Modelo = $row["Modelo"];
					$Variante = $row["Variante"];
				?>
					<tr>
						<td><?php echo $Marca ?></td>
						<td><?php echo $Modelo ?></a></td>
						<td><?php echo $Variante ?></td>
						<td><button onclick="delete<?php echo $row['idSolicitudes']; ?>()">ELIMINAR</button><button onclick="edit<?php echo $row['idSolicitudes']; ?>()">AGREGAR</button></td>
					</tr>
					<script>
						function delete<?php echo $row['idSolicitudes']; ?>() {
							if(confirm("Estás seguro que quieres eliminar la solicitud?")) document.location = '/deleteSolicitud.php?id=<?php echo $idSolicitudes ?>&fromfile=TRUE';
						}
						function edit<?php echo $row['idSolicitudes']; ?>() {
							if(confirm("Estás seguro que quieres agregar el nuevo equipo? Se eliminará de la lista de solicitudes")) document.location = '/add.php?id=<?php echo $idSolicitudes ?>&Marca=<?php echo $Marca ?>&Modelo=<?php echo $Modelo ?>&Variante=<?php echo $Variante ?>';
						}
					</script>
				<?php endwhile; ?>
		</div>
	</div>
</body>
</html>