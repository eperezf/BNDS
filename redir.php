<?php

session_start();
if (!isset($_GET["Operadora"])){
  $_SESSION["Alert"] = "Por favor selecciona una operadora";
  header("Location: /");
  die;
}

if ($_GET["Telefono"] == ""){
  $_SESSION["Alert"] = "Por favor busca un teléfono";
  header("Location: /");
  die;
}

else {
	$Telefono = str_replace(" ", "+", $_GET["Telefono"]);
	$Operadora = str_replace(" ", "+", $_GET["Operadora"]);
	header("Location: /ver/$Telefono/$Operadora");
}



