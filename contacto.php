<?php

session_start();
include ('config.php');
require_once('version.php');

?>
<html>
<head>
  <title>Verificador de bandas | bnds.cl</title>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <script src="js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
  <script src="js/collapse.js" type="text/javascript"></script>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://static.bnds.cl/css/custom.css">
  <link rel="stylesheet" href="http://static.bnds.cl/css/footer.css">
  <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <style>
    body {
      font-family: 'Titillium Web', sans-serif;
    }
  </style>
</head>
<body>
<?php include_once("analyticstracking.php"); ?>
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
        <li><a href="/">Inicio</a></li>    
        <li><a href="/about">Acerca de</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
  <?php if (!isset($_SESSION["FormError"])){$_SESSION["FormError"] = "";}; if ($_SESSION["FormError"] != ""):?>
    <div class="row">  
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION["FormError"]; $_SESSION["FormError"] = "" ?>
      </div>
    </div>
  <?php endif; ?>
  <h2>¿No encuentras tu teléfono? Envíanos los detalles y lo agregaremos.</h2>
  <div class="row">
    <form method="post" action="/enviado">
      <div class="form-group">
        <label for="Marca">Marca*</label>
        <input type="text" class="form-control" id="Marca" name="Marca" placeholder="Apple" required>
      </div>
      <div class="form-group">
        <label for="Modelo">Modelo*</label>
        <input type="text" class="form-control" id="Modelo" name="Modelo" placeholder="iPhone 5s" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Variante</label>
        <input type="text" class="form-control" id="Variante" name="Variante" placeholder="A1423">
      </div>
      <div class="form-group">
        <label for="email">Correo (No recibirás correos)*</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="" required>
      </div>
      <div class="g-recaptcha" data-sitekey="6LdB7iUTAAAAALXEBBm2pJOAjwESZsy9nqpy7XRi"></div>
      <br>
      <p>* Requerido</p>
      <button type="submit" class="btn btn-default">Enviar</button>
    </form>
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
</body>
</html>