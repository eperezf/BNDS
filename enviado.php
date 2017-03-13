<?php

session_start();
include('config.php');

if (!isset($_POST["email"])){
  $_SESSION["FormError"] = "No has ingresado un correo";
  header("Location: /contacto");
  die;
}
if (!isset($_POST["Marca"])){
  $_SESSION["FormError"] = "No has ingresado una marca";
  header("Location: /contacto");
  die;
}
if (!isset($_POST["Modelo"])){
  $_SESSION["FormError"] = "No has ingresado un modelo";
  header("Location: /contacto");
  die;
}

//Check if the captcha is done: 
$DATA = array('secret' => "6LdB7iUTAAAAAN5gicDJRhAogJFYTUhAjeUepXU3", 'response' => $_POST["g-recaptcha-response"]);
$ch = curl_init();
//Set cURL data:
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$DATA);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Get reCAPTCHA response:
$response = curl_exec ($ch);
curl_close ($ch);
$responseJSON = json_decode($response);
if ($responseJSON->success == 1){
  $CaptchaResult = "success";
}
else {
  $_SESSION["FormError"] = "el Captcha no es válido";
  header("Location: /contacto");
  die;
};

$query = "INSERT INTO `Solicitudes` (`idSolicitudes` ,`Marca` ,`Modelo` , `Variante`) VALUES (NULL ,  '" . mysqli_real_escape_string($conn, $_POST["Marca"]) . "', '" . mysqli_real_escape_string($conn, $_POST["Modelo"]) . "', '" . mysqli_real_escape_string($conn, $_POST["Variante"]) . "')";
$Result = mysqli_query($conn, $query);
 
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
  <h2>Solicitud recibida con éxito</h2>
  <h4>Lo agregaremos lo antes posible</h4>
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