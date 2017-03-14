<?php
require ('classes.php');
require ('config.php');
$Func = new CommonFunctions();
session_start();
$Func->CheckOperadora($_GET["Operadora"]);
$Func->CheckTelefono($_GET["Telefono"]);

if (ctype_digit($_GET["Telefono"])) {
  $TAC = mb_substr($_GET["Telefono"], 0, 8);
  $query = "SELECT Slug from Telefono WHERE idTelefono = (SELECT idTelefono from TAC where TAC = '$TAC')";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result)){
    $TSlug = $row["Slug"];
  }
}
else {
  $TInput = $Func->Slugify($_GET["Telefono"]);
  $Telefono = new Telefono(mysqli_real_escape_string($conn, $TInput));
  $TSlug = $Telefono->Slug;
}

$OSlug = $Func->Slugify($_GET["Operadora"]);
header("Location: /ver/$TSlug/$OSlug");
