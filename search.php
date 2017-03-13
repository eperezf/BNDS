<?php

$query = $_GET['q'];

include_once('config.php');
$array = array();


$sql="SELECT * FROM `Telefonos` WHERE `NombreCompleto` LIKE '%" . $query . "%' ORDER BY CASE WHEN `NombreCompleto` LIKE '" . mysqli_real_escape_string($conn, $query) . "%' THEN 1 ELSE 2 END, `NombreCompleto`";

$result=mysqli_query($conn, $sql);


while($row=mysqli_fetch_array($result))
{
 $array[] = $row['NombreCompleto'];

}

echo json_encode($array);


?> 