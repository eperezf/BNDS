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

  static public function Slugify($text){
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    if (empty($text)) {
      return 'n-a';
    }
    return $text;
  }

  function CheckOperadora($Operadora){
    if (!isset($Operadora)){
      $_SESSION["Alert"] = "Por favor selecciona una operadora";
      header("Location: /");
      die;
    }
  }

  function CheckTelefono($Telefono){
    if (!isset($Telefono)){
      $_SESSION["Alert"] = "Por favor busca un teléfono";
      header("Location: /");
      die;
    }
  }
}
