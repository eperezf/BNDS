<?

class CommonFunctions {
  function FetchTelcos(){
    include ('config.php');
    $query = "SELECT `Nombre` FROM `Operadora` ORDER BY `Nombre` ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)){
      echo "<option>" . $row["Nombre"] . "</option>";
    }
  }

}
