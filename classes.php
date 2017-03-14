<?
class CommonFunctions {

  public $OKIcon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ';
  public $WarningIcon = '<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> ';
  public $DangerIcon = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ';

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
	public $Identical = "TRUE";
	public $Similar = "FALSE";
	public $NombreCompleto;
	public $LTEA = "FALSE";
	public $HDVoice = "FALSE";
	public $SAE = "FALSE";
  public $Slug;

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
      $this->Slug = $row["Slug"];
      $this->NombreCompleto = $row["NombreCompleto"];
  		$this->LinkReview = $row["LinkReview"];
      if ($row["LTEA"] == "1"){
        $this->LTEA = "TRUE";
      };
      if ($row["HDVoice"] == "1"){
        $this->HDVoice = "TRUE";
      };
      if ($row["SAE"] == "1"){
        $this->SAE = "TRUE";
      }
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
        $this->Slug = $row["Slug"];
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

/**
* Clase para comparar teléfono y bandas
* @author Eduardo Pérez
* @version 1.1
* @category Processer
* @todo Nada por ahora
*/
class Comparacion {

  public $OKIcon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ';
  public $WarningIcon = '<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> ';
  public $DangerIcon = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ';

	public $GSM1900Result;
	public $GSM900Result;
	public $GSM850Result;
	public $UMTS1900Result;
	public $UMTS900Result;
	public $UMTS850Result;
	public $UMTSAWSResult;
	public $LTE2600Result;
	public $LTE700Result;
	public $LTEAWSResult;

	public $GSMResult;
	public $UMTSResult;
	public $LTEResult;

  public $LTEABoxText;
  public $LTEABoxType;
  public $LTEAResponse;

  public $HDVoiceBoxText;
  public $HDVoiceBoxType;
  public $HDVoiceResponse;

  public $SAEBoxText;
  public $SAEBoxType;
  public $SAEResponse;

	function ProcessBand ($OperadoraInput, $TelefonoInput, $BandaInput){

		if ($BandaInput == "GSM1900"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->GSM1900Result = "OK";
				return "La operadora posee banda 2G 1900MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->GSM1900Result = "ERROR";
				return "La operadora posee banda 2G 1900MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->GSM1900Result = "IRRELEVANT";
				return "La operadora no posee banda 2G 1900MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->GSM1900Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 2G 1900MHz. No importa.";
			};
		}
		if ($BandaInput == "GSM900"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->GSM900Result = "OK";
				return "La operadora posee banda 2G 900MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->GSM900Result = "ERROR";
				return "La operadora posee banda 2G 900MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->GSM900Result = "IRRELEVANT";
				return "La operadora no posee banda 2G 900MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->GSM900Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 2G 900MHz. No importa.";
			};
		}
		if ($BandaInput == "GSM850"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->GSM850Result = "OK";
				return "La operadora posee banda 2G 850MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->GSM850Result = "ERROR";
				return "La operadora posee banda 2G 850MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->GSM850Result = "IRRELEVANT";
				return "La operadora no posee banda 2G 850MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->GSM850Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 2G 850MHz. No importa.";
			};
		}
		if ($BandaInput == "UMTS1900"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->UMTS1900Result = "OK";
				return "La operadora posee banda 3G 1900MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->UMTS1900Result = "ERROR";
				return "La operadora posee banda 3G 1900MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->UMTS1900Result = "IRRELEVANT";
				return "La operadora no posee banda 3G 1900MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->UMTS1900Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 3G 1900MHz. No importa.";
			};
		}
		if ($BandaInput == "UMTS900"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->UMTS900Result = "OK";
				return "La operadora posee banda 3G 900MHz. y el teléfono es compatible.";

			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->UMTS900Result = "ERROR";
				return "La operadora posee banda 3G 900MHz. pero el teléfono no es compatible.";

			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->UMTS900Result = "IRRELEVANT";
				return "La operadora no posee banda 3G 900MHz. y el teléfono sí. No importa.";

			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->UMTS900Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 3G 900MHz. No importa.";

			};
		}
		if ($BandaInput == "UMTS850"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->UMTS850Result = "OK";
				return "La operadora posee banda 3G 850MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->UMTS850Result = "ERROR";
				return "La operadora posee banda 3G 850MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->UMTS850Result = "IRRELEVANT";
				return "La operadora no posee banda 3G 850MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->UMTS850Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 3G 850MHz. No importa.";
			};
		}
		if ($BandaInput == "UMTSAWS"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->UMTSAWSResult = "OK";
				return "La operadora posee banda 3G 1700/2100MHz. (AWS) y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->UMTSAWSResult = "ERROR";
				return "La operadora posee banda 3G 1700/2100MHz. (AWS) pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->UMTSAWSResult = "IRRELEVANT";
				return "La operadora no posee banda 3G 1700/2100MHz. (AWS) y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->UMTSAWSResult = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 3G 1700/2100MHz. (AWS) No importa.";
			};
		}
		if ($BandaInput == "LTE2600"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->LTE2600Result = "OK";
				return "La operadora posee banda 4G 2600MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->LTE2600Result = "ERROR";
				return "La operadora posee banda 4G 2600MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->LTE2600Result = "IRRELEVANT";
				return "La operadora no posee banda 4G 2600MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->LTE2600Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 4G 2600MHz. No importa.";
			};
		}
		if ($BandaInput == "LTE700"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->LTE700Result = "OK";
				return "La operadora posee banda 4G 700MHz. y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->LTE700Result = "ERROR";
				return "La operadora posee banda 4G 700MHz. pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->LTE700Result = "IRRELEVANT";
				return "La operadora no posee banda 4G 700MHz. y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->LTE700Result = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 4G 700MHz. No importa.";
			};
		}
		if ($BandaInput == "LTEAWS"){
			if ($OperadoraInput == "TRUE" && $TelefonoInput == "TRUE"){
				$this->LTEAWSResult = "OK";
				return "La operadora posee banda 4G 1700/2100MHz. (AWS) y el teléfono es compatible.";
			}
			elseif ($OperadoraInput == "TRUE" && $TelefonoInput == "FALSE"){
				$this->LTEAWSResult = "ERROR";
				return "La operadora posee banda 4G 1700/2100MHz. (AWS) pero el teléfono no es compatible.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "TRUE"){
				$this->LTEAWSResult = "IRRELEVANT";
				return "La operadora no posee banda 4G 1700/2100MHz. (AWS) y el teléfono sí. No importa.";
			}
			elseif ($OperadoraInput == "FALSE" && $TelefonoInput == "FALSE"){
				$this->LTEAWSResult = "IRRELEVANT";
				return "Ni la operadora ni el teléfono poseen banda 4G 1700/2100MHz. (AWS) No importa.";
			};
		}
	}

	function ProcessResult (){
		if ($this->GSM1900Result == "ERROR" || $this->GSM900Result == "ERROR" || $this->GSM850Result == "ERROR"){
			if ($this->GSM1900Result == "OK" || $this->GSM900Result == "OK" || $this->GSM850Result == "OK"){
				$this->GSMResult = "PARTIAL";
			}
			else {
				$this->GSMResult = "ERROR";
			};
		}
		else {
			$this->GSMResult = "OK";
		};

		if ($this->UMTS1900Result == "ERROR" || $this->UMTS900Result == "ERROR" || $this->UMTS850Result == "ERROR" || $this->UMTSAWSResult == "ERROR"){
			if ($this->UMTS1900Result == "OK" || $this->UMTS900Result == "OK" || $this->UMTS850Result == "OK" || $this->UMTSAWSResult == "OK"){
				$this->UMTSResult = "PARTIAL";
			}
			else {
				$this->UMTSResult = "ERROR";
			};
		}
		else {
			$this->UMTSResult = "OK";
		};

		if ($this->LTE2600Result == "ERROR" || $this->LTE700Result == "ERROR" || $this->LTEAWSResult == "ERROR"){
			if ($this->LTE2600Result == "OK" || $this->LTE700Result == "OK" || $this->LTEAWSResult == "OK"){
				$this->LTEResult = "PARTIAL";
			}
			else {
				$this->LTEResult = "ERROR";
			};
		}
		else {
			$this->LTEResult = "OK";
		};
	}

  function ProcessLTEA($Operadora, $Telefono, $OperadoraNombre){
    if ($Operadora == "TRUE" && $Telefono == "TRUE"){
      //Operadora y teléfono comaptibles
      $this->LTEABoxText = $this->OKIcon . " Compatible con 4G+";
      $this->LTEABoxType = "Success";
      $this->LTEAResponse = 'es compatible con 4G+.';
    }
    elseif ($Operadora == "TRUE" && $Telefono == "FALSE"){
      //Solo operadora compatible
      $this->LTEABoxText = $this->DangerIcon . " No compatible con 4G+";
      $this->LTEABoxType = "danger";
      $this->LTEAResponse = 'no es compatible con 4G+.';
    }
    elseif ($Operadora == "FALSE" && $Telefono == "TRUE"){
      //Solo teléfono compatible
      $this->LTEABoxText = $this->WarningIcon . " Compatible con 4G+";
      $this->LTEABoxType = "warning";
      $this->LTEAResponse = 'es compatible con 4G+ pero ' . $OperadoraNombre . ' no posee este servicio.';
    }
    elseif ($Operadora == "FALSE" && $Telefono == "FALSE"){
      //Ninguno es compatible
      $this->LTEABoxText = $this->DangerIcon . " No compatible con 4G+";
      $this->LTEABoxType = "danger";
      $this->LTEAResponse = 'no es compatible con 4G+.';
    }
  }

  function ProcessHDVoice($Operadora, $Telefono, $OperadoraNombre){
    if ($Operadora == "TRUE" && $Telefono == "TRUE"){
      //Operadora y teléfono comaptibles
      $this->HDVoiceBoxText = $this->OKIcon . " Compatible con Voz HD";
      $this->HDVoiceBoxType = "Success";
      $this->HDVoiceResponse = 'es compatible con Voz HD.';
    }
    elseif ($Operadora == "TRUE" && $Telefono == "FALSE"){
      //Solo operadora compatible
      $this->HDVoiceBoxText = $this->DangerIcon . " No compatible con Voz HD";
      $this->HDVoiceBoxType = "danger";
      $this->HDVoiceResponse = 'no es compatible con Voz HD.';
    }
    elseif ($Operadora == "FALSE" && $Telefono == "TRUE"){
      //Solo teléfono compatible
      $this->HDVoiceBoxText = $this->WarningIcon . " Compatible con Voz HD";
      $this->HDVoiceBoxType = "warning";
      $this->HDVoiceResponse = 'es compatible con Voz HD pero ' . $OperadoraNombre . ' no posee este servicio.';
    }
    elseif ($Operadora == "FALSE" && $Telefono == "FALSE"){
      //Ninguno es compatible
      $this->HDVoiceBoxText = $this->DangerIcon . " No compatible con Voz HD";
      $this->HDVoiceBoxType = "danger";
      $this->HDVoiceResponse = 'no es compatible con Voz HD.';
    }
  }

  function ProcessSAE($Telefono){
    if ($Telefono == "TRUE"){
      $this->SAEBoxText = $this->OKIcon . " Compatible con SAE";
      $this->SAEBoxType = "Success";
      $this->SAEResponse = 'es compatible con el Sistema de Alertas de Emergencia.';
    }
    else {
      $this->SAEBoxText = $this->DangerIcon . " No compatible con SAE";
      $this->SAEBoxType = "danger";
      $this->SAEResponse = "no es compatible con el Sistema de Alertas de Emergencia.";
    };
  }
}
