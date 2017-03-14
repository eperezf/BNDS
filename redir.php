<?php
require ('classes.php');
require ('config.php');
$Func = new CommonFunctions();
session_start();
$Func->CheckOperadora($_GET["Operadora"]);
$Func->CheckTelefono($_GET["Telefono"]);
if (ctype_digit($_GET["Telefono"])) {
  $_SESSION["Alert"] = "Estás buscando un IMEI!";
  header("Location: /");
  die;
}
$TInput = $Func->Slugify($_GET["Telefono"]);
$Telefono = new Telefono(mysqli_real_escape_string($conn, $TInput));
$TSlug = $Telefono->Slug;
$OSlug = $Func->Slugify($_GET["Operadora"]);
header("Location: /ver/$TSlug/$OSlug");
