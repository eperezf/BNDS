<?php
require ('classes.php');
$Func = new CommonFunctions();

session_start();

$Func->CheckOperadora($_GET["Operadora"]);

$Func->CheckTelefono($_GET["Telefono"]);

if (ctype_digit($_GET["Telefono"])) {
  $_SESSION["Alert"] = "Estás buscando un IMEI!";
  header("Location: /");
  die;
}
$Telefono = $Func->Slugify($_GET["Telefono"]);
$Operadora = $Func->Slugify($_GET["Operadora"]);
header("Location: /ver/$Telefono/$Operadora");
