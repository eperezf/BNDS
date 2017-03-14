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

/**
* Clase para obtener los datos de la operadora desde la base de datos.
* @version 1.1
* @category Fetcher
* @todo Nada por ahora
*/
class Operadora {

	//Datos generales de la operadora
	public $ID="";
	public $Nombre="";
	public $Tipo="";
  public $LTEA = "FALSE";
  public $HDVoice = "FALSE";

	//Datos de las Banda de la operadora
	//GSM 1900
	public $GSM1900 = "FALSE";
	public $GSM1900Roaming = "FALSE";
	public $GSM1900RoamingOperadora;
	//GSM 900
	public $GSM900 = "FALSE";
	public $GSM900Roaming = "FALSE";
	public $GSM900RoamingOperadora;
	//GSM 850
	public $GSM850 = "FALSE";
	public $GSM850Roaming = "FALSE";
	public $GSM850RoamingOperadora;
	//UMTS 1900
	public $UMTS1900 = "FALSE";
	public $UMTS1900Roaming = "FALSE";
	public $UMTS1900RoamingOperadora;
	//UMTS 850
	public $UMTS850 = "FALSE";
	public $UMTS850Roaming = "FALSE";
	public $UMTS850RoamingOperadora;
	//UMTS 900
	public $UMTS900 = "FALSE";
	public $UMTS900Roaming = "FALSE";
	public $UMTS900RoamingOperadora;
	//UMTS AWS
	public $UMTSAWS = "FALSE";
	public $UMTSAWSRoaming = "FALSE";
	public $UMTSAWSRoamingOperadora;
	//LTE 2600
	public $LTE2600 = "FALSE";
	public $LTE2600Roaming = "FALSE";
	public $LTE2600RoamingOperadora;
	//LTE 700
	public $LTE700 = "FALSE";
	public $LTE700Roaming = "FALSE";
	public $LTE700RoamingOperadora;
	//LTE AWS
	public $LTEAWS = "FALSE";
	public $LTEAWSRoaming = "FALSE";
	public $LTEAWSRoamingOperadora;


	//Función para obtener los datos de la operadora consultada
	function __construct ($Operadora){
		include('config.php');
		$query = "SELECT * FROM `Operadora` WHERE `Slug` = '" . mysqli_real_escape_string($conn, $Operadora) . "'";
		$result = mysqli_query($conn, $query);
		while ($row=mysqli_fetch_array($result)){
			$this->ID = $row["idOperadora"];
			$this->Nombre = $row["Nombre"];
			$this->Tipo = $row["Tipo"];
      if ($row["LTEA"] == "1"){
        $this->LTEA = "TRUE";
      };
      if ($row["HDVoice"] == "1"){
        $this->HDVoice = "TRUE";
      };
		};
	}

	//Función para obtener las Banda y roeaming de estas si existen
	function GetBandas (){
		include('config.php');
		$conn->set_charset("utf8");

		//GSM
		if ($this->ID != ""){
			$query = "SELECT * FROM `Operadora`, `Banda`, `Operadora_Banda` WHERE `Banda`.`Tipo`='2G' and `Operadora_Banda`.`idOperadora` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Operadora`.`idOperadora` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Banda`.`idBanda` = `Operadora_Banda`.`idBanda`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "1900"){
					$this->GSM1900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->GSM1900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM1900RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				}

				elseif($row["Frecuencia"] == "900"){
					$this->GSM900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->GSM900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM900RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				}
				elseif($row["Frecuencia"] == "850"){
					$this->GSM850 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->GSM850Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->GSM850RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				};
			}
			$query = "";
			$result = "";
			$row = "";

			//UMTS
			$query = "SELECT * FROM `Operadora`, `Banda`, `Operadora_Banda` WHERE `Banda`.`Tipo`='3G' and `Operadora_Banda`.`idOperadora` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Operadora`.`idOperadora` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Banda`.`idBanda` = `Operadora_Banda`.`idBanda`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "1900"){
					$this->UMTS1900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTS1900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS1900RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				}
				elseif($row["Frecuencia"] == "900"){
					$this->UMTS900 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTS900Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS900RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				}
				elseif($row["Frecuencia"] == "1700"){
					$this->UMTSAWS = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTSAWSRoaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTSAWSRoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				}
				elseif($row["Frecuencia"] == "850"){
					$this->UMTS850 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->UMTS850Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->UMTS850RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				};
			}
			$query = "";
			$result = "";
			$row = "";

			//LTE
			$query = "SELECT * FROM `Operadora`, `Banda`, `Operadora_Banda` WHERE `Banda`.`Tipo`='4G' and `Operadora_Banda`.`idOperadora` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Operadora`.`idOperadora` =" . mysqli_real_escape_string($conn, $this->ID) . " AND `Banda`.`idBanda` = `Operadora_Banda`.`idBanda`";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){
				if ($row["Frecuencia"] == "2600"){
					$this->LTE2600 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->LTE2600Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTE2600RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				}
				elseif($row["Frecuencia"] == "700"){
					$this->LTE700 = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->LTE700Roaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTE700RoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				}
				elseif($row["Frecuencia"] == "1700"){
					$this->LTEAWS = "TRUE";
					if ($row["Roaming"] == "1"){
						$this->LTEAWSRoaming = "TRUE";
						$queryRoaming = "SELECT `Nombre` FROM Operadora WHERE idOperadora =" . mysqli_real_escape_string($conn, $row["idOperadora_Roaming"]);
						$resultRoaming = mysqli_query($conn, $queryRoaming);
						while ($rowRoaming = mysqli_fetch_array($resultRoaming)){
							$this->LTEAWSRoamingOperadora = $rowRoaming["Nombre"];
						};
						$rowRoaming = "";
						$queryRoaming = "";
						$resultRoaming = "";
					}
					else{
					}
				};
			}
		}
	}
}

/**
* Clase para obtener los datos del teléfono desde la base de datos.
* @author Eduardo Pérez
* @version 1.1
* @category Fetcher
* @todo Nada por ahora
* @uses $var = new Telefono(Nombre) genera el query y carga los datos.
*/
class Telefono {

	//Datos generales del teléfono
	public $ID;
	public $Marca;
	public $Modelo;
	public $Variante;
	public $LinkReview;
	public $Identical;
	public $Similar;
	public $NombreCompleto;
	public $LTEA = "FALSE";
	public $HDVoice = "FALSE";
	public $SAE = "FALSE";

	//Datos de las Banda del teléfono
	public $GSM1900 = "FALSE";
	public $GSM900 = "FALSE";
	public $GSM850 = "FALSE";
	public $UMTS1900 = "FALSE";
	public $UMTS900 = "FALSE";
	public $UMTS850 = "FALSE";
	public $UMTSAWS = "FALSE";
	public $LTE2600 = "FALSE";
	public $LTE700 = "FALSE";
	public $LTEAWS = "FALSE";


	function __construct ($NameInput){
		include('config.php');
		$conn->set_charset("utf8");
		$query = "SELECT * FROM `Telefono` WHERE `Slug` = '" . mysqli_real_escape_string($conn, $NameInput) . "'";
		$result = mysqli_query($conn, $query);
		while($row=mysqli_fetch_array($result)){
			$this->ID = $row ["idTelefono"];
  		$this->Marca = $row["Marca"];
  		$this->Modelo = $row["Modelo"];
  		$this->Variante = $row["Variante"];
      $this->NombreCompleto = $row["NombreCompleto"];
  		$this->LinkReview = $row["LinkReview"];
  		$this->LTEA = $row["LTEA"];
  		$this->HDVoice = $row["HDVoice"];
  		$this->SAE = $row["SAE"];
		};
		$query = "";
		$result = "";
		$row = "";
		if ($this->Marca == ""){
			$this->Identical = "FALSE";
			$this->Similar = "TRUE";
			$query = "SELECT * FROM `Telefono` WHERE `Slug` LIKE '%" . mysqli_real_escape_string($conn, $NameInput) . "%'";
			$result = mysqli_query($conn, $query);
			while($row=mysqli_fetch_array($result)){
				$this->ID = $row ["idTelefono"];
	  		$this->Marca = $row["Marca"];
	  		$this->Modelo = $row["Modelo"];
	  		$this->Variante = $row["Variante"];
        $this->NombreCompleto = $row["NombreCompleto"];
	  		$this->LinkReview = $row["LinkReview"];
	  		$this->LTEA = $row["LTEA"];
	  		$this->HDVoice = $row["HDVoice"];
	  		$this->SAE = $row["SAE"];
			};
		}
		$query = "";
		$result = "";
		$row = "";

		$query = "SELECT * FROM `Telefono_Banda` WHERE `idTelefono` = '" . mysqli_real_escape_string($conn, $this->ID) . "'";
		$result = mysqli_query ($conn, $query);
		while ($row = mysqli_fetch_array($result)){
			if ($row["idBanda"] == "1"){
				$this->GSM1900 = "TRUE";
			}
			elseif ($row["idBanda"] == "2"){
				$this->GSM900 = "TRUE";
			}
			elseif ($row["idBanda"] == "3"){
				$this->GSM850 = "TRUE";
			}
			elseif ($row["idBanda"] == "4"){
				$this->UMTS1900 = "TRUE";
			}
			elseif ($row["idBanda"] == "5"){
				$this->UMTS850 = "TRUE";
			}
			elseif ($row["idBanda"] == "6"){
				$this->UMTS900 = "TRUE";
			}
			elseif ($row["idBanda"] == "7"){
				$this->UMTSAWS = "TRUE";
			}
			elseif ($row["idBanda"] == "8"){
				$this->LTE2600 = "TRUE";
			}
			elseif ($row["idBanda"] == "9"){
				$this->LTE700 = "TRUE";
			}
			elseif ($row["idBanda"] == "10"){
				$this->LTEAWS = "TRUE";
			};
		}
	}
}
