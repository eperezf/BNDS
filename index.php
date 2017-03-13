<?php

session_start();
include ('config.php');
require ('classes.php');
$Func = new CommonFunctions();
require_once('version.php');
?>
<html>
<head>
  <title>Verificador de bandas | bnds.cl</title>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <script src="js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
  <script src="js/collapse.js" type="text/javascript"></script>
  <script src="https://use.fontawesome.com/c06f79f082.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://static.bnds.cl/css/custom.css">
  <link rel="stylesheet" href="http://static.bnds.cl/css/footer.css">
  <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
  <style>
    body {
      font-family: 'Titillium Web', sans-serif;
    }
  </style>
</head>
<body>
<?php //include_once("analyticstracking.php") ?>
<!--Inicio Navbar-->
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand navbar-active" href="/">
        <img src="http://static.bnds.cl/img/Logo.png" class="img-responsive">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Inicio</a></li>
        <li><a href="/about">Acerca de</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
  <?php if (!isset($_SESSION["Alert"])){$_SESSION["Alert"] = "";}; if ($_SESSION["Alert"] != ""):?>
    <div class="row">
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION["Alert"]; $_SESSION["Alert"] = "" ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-12">
      <h1><p class="text-center">Revisa si tu teléfono es compatible</p></h1>
    </div>
    <div class="col-md-12">
      <h4><p class="text-center">Busca el modelo de tu teléfono y la operadora que quieres usar</p></h4>
    </div>
  </div>
  <div class="row">
    <form action="redir.php" method="get">
      <div class="col-md-12 col-lg-6">
        <h4><p class="text-center">Ingresa la marca, modelo y variante o el IMEI de tu teléfono</p></h4>
        <input class="form-control" id="typeahead-input" type="text" data-provide="typeahead" name="Telefono" autocomplete="off">
      </div>
      <div class="col-md-12 col-lg-6">
        <h4><p class="text-center">Selecciona tu operadora</p></h4>
        <select class="form-control" id="Operadora" name="Operadora">
          <?php
            $Func->FetchTelcos();
          ?>
        </select>
        <br/>
        <br/>
      </div>
      <div class="col-md-12 col-lg-12">
        <button type="submit" class="btn btn-primary center-block">Verificar</button>
      </div>
    </form>
    <div class="col-md-12 col-lg-12">
      <br>
      <br>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="container">
    <p class="text-muted">Verificador de Bandas <a href="/about"><?php echo $Version ?></a> Copyright © <?php echo date("Y") ?> Pisapapeles Networks Ltda.
      <br>Logos, material gráfico, y cualquier marca registrada es propiedad de sus respectivos dueños
      <br>Pisapapeles Networks Ltda. no se hace responsable por errores en la base de datos.
    </p>
  </div>
</footer>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      $('#typeahead-input').typeahead({
        source: function (query, process) {
          return $.get('search.php?q=' + query, function (data) {
            return process(JSON.parse(data));
          });
        }
      });
    })
  </script>
</body>
</html>
