<?php


class EditPhone {
	public $ID ="";
	public $Marca = "";
	public $Modelo = "";
	public $Variante = "";
	public $LinkReview = "";
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
	public $LTEA = "";
	public $HDVoice = "";
	public $SAE = "";
	public $NombreCompleto = "";

	public $MarcaOld = "";
	public $ModeloOld = "";
	public $VarianteOld = "";
	public $LinkReviewOld = "";
	public $GSM1900Old = "FALSE";
	public $GSM900Old = "FALSE";
	public $GSM850Old = "FALSE";
	public $UMTS1900Old = "FALSE";
	public $UMTS900Old = "FALSE";
	public $UMTS850Old = "FALSE";
	public $UMTSAWSOld = "FALSE";
	public $LTE2600Old = "FALSE";
	public $LTE700Old = "FALSE";
	public $LTEAWSOld = "FALSE";
	public $LTEAOld = "";
	public $HDVoiceOld = "";
	public $SAEOld = "";
	public $NombreCompletoOld = "";

	public $DataUpdateQuery;
	public $FreqUpdateQuery;

	public $DataUpdateResult;
	public $DataUpdateResponse;

	public $FreqUpdateResult;
	public $FreqUpdateResponse;

	function __construct (){

		//Sección de GSM
		if (isset($_POST["GSM1900"])){
			$this->GSM1900 = "TRUE";
		}
		else {
			$this->GSM1900 = "FALSE";
		};
		if (isset($_POST["GSM900"])){
			$this->GSM900 = "TRUE";
		}
		else {
			$this->GSM900 = "FALSE";
		};
		if (isset($_POST["GSM850"])){
			$this->GSM850 = "TRUE";
		}
		else {
			$this->GSM850 = "FALSE";
		};

		//Sección de UMTS
		if (isset($_POST["UMTS1900"])){
			$this->UMTS1900 = "TRUE";
		}
		else {
			$this->UMTS1900 = "FALSE";
		};
		if (isset($_POST["UMTS900"])){
			$this->UMTS900 = "TRUE";
		}
		else {
			$this->UMTS900 = "FALSE";
		};
		if (isset($_POST["UMTS850"])){
			$this->UMTS850 = "TRUE";
		}
		else {
			$this->UMTS850 = "FALSE";
		};
		if (isset($_POST["UMTSAWS"])){
			$this->UMTSAWS = "TRUE";
		}
		else {
			$this->UMTSAWS = "FALSE";
		};

		//Sección de LTE
		if (isset($_POST["LTE2600"])){
			$this->LTE2600 = "TRUE";
		}
		else {
			$this->LTE2600 = "FALSE";
		};
		if (isset($_POST["LTE700"])){
			$this->LTE700 = "TRUE";
		}
		else {
			$this->LTE700 = "FALSE";
		};
		if (isset($_POST["LTEAWS"])){
			$this->LTEAWS = "TRUE";
		}
		else {
			$this->LTEAWS = "FALSE";
		};

		//Sección de Otros
		if (isset($_POST["LTEA"])){
			$this->LTEA = "1";
		}
		else {
			$this->LTEA = "0";
		}
		if (isset($_POST["HDVoice"])){
			$this->HDVoice = "1";
		}
		else {
			$this->HDVoice = "0";
		}
		if (isset($_POST["SAE"])){
			$this->SAE = "1";
		}
		else {
			$this->SAE = "0";
		}

		//Marca, modelo, variante, nombre completo
		$this->Marca = $_POST["Marca"];
		$this->Modelo = $_POST["Modelo"];
		$this->Variante = $_POST["Variante"];
		$this->NombreCompleto = $this->Marca . " " . $this->Modelo . " " . $this->Variante;
		$this->LinkReview = $_POST["Review"];

	}

	function GetOldData ($id){
		include('config.php');
		$conn->set_charset("utf8");
		$query = "SELECT * FROM `Telefonos` WHERE `idTelefonos` = '" . mysqli_real_escape_string($conn, $id) . "'";
		$result = mysqli_query($conn, $query);
		while($row=mysqli_fetch_array($result)){
			$this->ID = $row["idTelefonos"];
  		$this->MarcaOld = $row["Marca"];
  		$this->ModeloOld = $row["Modelo"];
  		$this->VarianteOld = $row["Variante"];
  		$this->LinkReviewOld = $row["LinkReview"];
  		$this->LTEAOld = $row["LTEA"];
  		$this->HDVoiceOld = $row["HDVoice"];
  		$this->SAEOld = $row["SAE"];
		};
		$this->NombreCompletoOld = $this->MarcaOld . " " . $this->ModeloOld . " " . $this->VarianteOld;
		$query = "";
		$result = "";
		$row = "";

		$query = "SELECT * FROM `Telefonos_Bandas` WHERE `idTelefonos` = '" . mysqli_real_escape_string($conn, $id) . "'";
		$result = mysqli_query ($conn, $query);
		while ($row = mysqli_fetch_array($result)){
			if ($row["idBandas"] == "1"){
				$this->GSM1900Old = "TRUE";
			}
			elseif ($row["idBandas"] == "2"){
				$this->GSM900Old = "TRUE";
			}
			elseif ($row["idBandas"] == "3"){
				$this->GSM850Old = "TRUE";
			}
			elseif ($row["idBandas"] == "4"){
				$this->UMTS1900Old = "TRUE";
			}
			elseif ($row["idBandas"] == "5"){
				$this->UMTS850Old = "TRUE";
			}
			elseif ($row["idBandas"] == "6"){
				$this->UMTS900Old = "TRUE";
			}
			elseif ($row["idBandas"] == "7"){
				$this->UMTSAWSOld = "TRUE";
			}
			elseif ($row["idBandas"] == "8"){
				$this->LTE2600Old = "TRUE";
			}
			elseif ($row["idBandas"] == "9"){
				$this->LTE700Old = "TRUE";
			}
			elseif ($row["idBandas"] == "10"){
				$this->LTEAWSOld = "TRUE";
			};
		}
	}

	function CreateUpdateQuery (){
		$this->DataUpdateQuery = "UPDATE Telefonos SET ";
		if ($this->MarcaOld != $this->Marca){
			$this->DataUpdateQuery = $this->DataUpdateQuery . "Marca = '$this->Marca', ";
		}
		if ($this->ModeloOld != $this->Modelo){
			$this->DataUpdateQuery = $this->DataUpdateQuery . "Modelo = '$this->Modelo', ";
		}
		if ($this->VarianteOld != $this->Variante){
			$this->DataUpdateQuery = $this->DataUpdateQuery . "Variante = '$this->Variante', ";
		}
		if ($this->NombreCompletoOld != $this->NombreCompleto){
			$this->DataUpdateQuery = $this->DataUpdateQuery . "NombreCompleto= '$this->NombreCompleto', ";
		}
		if ($this->LinkReviewOld != $this->LinkReview){
			$this->DataUpdateQuery = $this->DataUpdateQuery . "LinkReview = '$this->LinkReview', ";
		}
		if ($this->LTEAOld != $this->LTEA){
			$this->DataUpdateQuery = $this->DataUpdateQuery . "LTEA = '$this->LTEA', ";
		}
		if ($this->HDVoiceOld != $this->HDVoice){
			$this->DataUpdateQuery = $this->DataUpdateQuery . "HDVoice = '$this->HDVoice', ";
		}
		if ($this->SAEOld != $this->SAE){
			$this->DataUpdateQuery = $this->DataUpdateQuery . "SAE = '$this->SAE', ";
		}
		$this->DataUpdateQuery = substr($this->DataUpdateQuery, 0, -2);

		$this->DataUpdateQuery = $this->DataUpdateQuery . " WHERE idtelefonos = '$this->ID'";

	}
	function DoUpdateQuery (){
		include('config.php');
		$conn->set_charset("utf8");
		$Result = mysqli_query($conn, $this->DataUpdateQuery);
		if (! $Result){
			$this->DataUpdateResult = "ERROR";
			$this->DataUpdateResponse = "Ha ocurrido un error al editar el teléfono. o no hay cambios que realizar";
		}
		else {
			$this->DataUpdateResult = "OK";
			$this->DataUpdateResponse = "Teléfono editado correctamente";
		}
	}

	function BandsUpdateProcess (){
		include('config.php');
		$conn->set_charset("utf8");
		if ($this->GSM1900Old == $this->GSM1900){
		}
		elseif ($this->GSM1900Old == "TRUE" && $this->GSM1900 == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '1'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->GSM1900Old == "FALSE" && $this->GSM1900 == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '1')";
			$Result = mysqli_query($conn, $query);
		}
		else {
		}

		if ($this->GSM900Old == $this->GSM900){

		}
		elseif ($this->GSM900Old == "TRUE" && $this->GSM900 == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '2'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->GSM900Old == "FALSE" && $this->GSM900 == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '2')";
			$Result = mysqli_query($conn, $query);
		}

		if ($this->GSM850Old == $this->GSM850){

		}
		elseif ($this->GSM850Old == "TRUE" && $this->GSM850 == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '3'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->GSM850Old == "FALSE" && $this->GSM850 == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '3')";
			$Result = mysqli_query($conn, $query);
		}

		if ($this->UMTS1900Old == $this->UMTS1900){

		}
		elseif ($this->UMTS1900Old == "TRUE" && $this->UMTS1900 == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '4'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->UMTS1900Old == "FALSE" && $this->UMTS1900 == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '4')";
			$Result = mysqli_query($conn, $query);
		}

		if ($this->UMTS850Old == $this->UMTS850){

		}
		elseif ($this->UMTS850Old == "TRUE" && $this->UMTS850 == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '5'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->UMTS850Old == "FALSE" && $this->UMTS850 == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '5')";
			$Result = mysqli_query($conn, $query);
		}

		if ($this->UMTS900Old == $this->UMTS900){

		}
		elseif ($this->UMTS900Old == "TRUE" && $this->UMTS900 == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '6'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->UMTS900Old == "FALSE" && $this->UMTS900 == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '6')";
			$Result = mysqli_query($conn, $query);
		}

		if ($this->UMTSAWSOld == $this->UMTSAWS){

		}
		elseif ($this->UMTSAWSOld == "TRUE" && $this->UMTSAWS == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '7'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->UMTSAWSOld == "FALSE" && $this->UMTSAWS == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '7')";
			$Result = mysqli_query($conn, $query);
		}

		if ($this->LTE2600Old == $this->LTE2600){

		}
		elseif ($this->LTE2600Old == "TRUE" && $this->LTE2600 == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '8'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->LTE2600Old == "FALSE" && $this->LTE2600 == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '8')";
			$Result = mysqli_query($conn, $query);
		}

		if ($this->LTE700Old == $this->LTE700){

		}
		elseif ($this->LTE700Old == "TRUE" && $this->LTE700 == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '9'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->LTE700Old == "FALSE" && $this->LTE700 == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '9')";
			$Result = mysqli_query($conn, $query);
		}

		if ($this->LTEAWSOld == $this->LTEAWS){

		}
		elseif ($this->LTEAWSOld == "TRUE" && $this->LTEAWS == "FALSE") {
			$query = "DELETE FROM Telefonos_Bandas WHERE idTelefonos = '$this->ID' AND idBandas = '10'";
			$Result = mysqli_query($conn, $query);
		}
		elseif ($this->LTEAWSOld == "FALSE" && $this->LTEAWS == "TRUE") {
			$query = "INSERT INTO Telefonos_Bandas (idTelefonos, idBandas) VALUES ('$this->ID', '10')";
			$Result = mysqli_query($conn, $query);
		}

	}

}


/**
* Clase para agregar un teléfono a la base de datos
* @author Eduardo Pérez
* @version 1.1
* @category POSTer
* @todo Nada por ahora
*/

class InputPhone {

	//Datos del teléfono a agregar
	public $Marca = "";
	public $Modelo = "";
	public $Variante = "";
	public $LinkReview = "";
	public $GSM1900 = "";
	public $GSM900 = "";
	public $GSM850 = "";
	public $UMTS1900 = "";
	public $UMTS900 = "";
	public $UMTS850 = "";
	public $UMTSAWS = "";
	public $LTE2600 = "";
	public $LTE700 = "";
	public $LTEAWS = "";
	public $LTEA = "";
	public $HDVoice = "";
	public $SAE = "";
	public $NombreCompleto = "";

	//Datos de inserción de datos del teléfono y resultados
	public $InsertTelefonoResult = "";
	public $InsertTelefonoResponse = "";
	public $InsertTelefonoID = "";
	public $InsertBandasResult = "";
	public $InsertBandasResponse = "";

	//Datos para decidir otras funciones
	public $DuplicateMatch = "FALSE";

	//Función para obtener los datos desde el POST
	function GetPOST(){
		include('config.php');

		//Sección de GSM
		if (isset($_POST["GSM1900"])){
			$this->GSM1900 = "TRUE";
		}
		else {
			$this->GSM1900 = "FALSE";
		};
		if (isset($_POST["GSM900"])){
			$this->GSM900 = "TRUE";
		}
		else {
			$this->GSM900 = "FALSE";
		};
		if (isset($_POST["GSM850"])){
			$this->GSM850 = "TRUE";
		}
		else {
			$this->GSM850 = "FALSE";
		};

		//Sección de UMTS
		if (isset($_POST["UMTS1900"])){
			$this->UMTS1900 = "TRUE";
		}
		else {
			$this->UMTS1900 = "FALSE";
		};
		if (isset($_POST["UMTS900"])){
			$this->UMTS900 = "TRUE";
		}
		else {
			$this->UMTS900 = "FALSE";
		};
		if (isset($_POST["UMTS850"])){
			$this->UMTS850 = "TRUE";
		}
		else {
			$this->UMTS850 = "FALSE";
		};
		if (isset($_POST["UMTSAWS"])){
			$this->UMTSAWS = "TRUE";
		}
		else {
			$this->UMTSAWS = "FALSE";
		};

		//Sección de LTE
		if (isset($_POST["LTE2600"])){
			$this->LTE2600 = "TRUE";
		}
		else {
			$this->LTE2600 = "FALSE";
		};
		if (isset($_POST["LTE700"])){
			$this->LTE700 = "TRUE";
		}
		else {
			$this->LTE700 = "FALSE";
		};
		if (isset($_POST["LTEAWS"])){
			$this->LTEAWS = "TRUE";
		}
		else {
			$this->LTEAWS = "FALSE";
		};

		//Sección de Otros
		if (isset($_POST["LTEA"])){
			$this->LTEA = "1";
		}
		else {
			$this->LTEA = "0";
		}
		if (isset($_POST["HDVoice"])){
			$this->HDVoice = "1";
		}
		else {
			$this->HDVoice = "0";
		}
		if (isset($_POST["SAE"])){
			$this->SAE = "1";
		}
		else {
			$this->SAE = "0";
		}

		//Marca, modelo, variante, nombre completo



		$this->Marca = mysqli_real_escape_string($conn, $_POST["Marca"]);
		$this->Modelo = mysqli_real_escape_string($conn, $_POST["Modelo"]);
		$this->Variante = mysqli_real_escape_string($conn, $_POST["Variante"]);
		$this->NombreCompleto = $this->Marca . " " . $this->Modelo . " " . $this->Variante;
		$this->LinkReview = mysqli_real_escape_string($conn, $_POST["Review"]);

	}

	//Función para saber si hay un duplicado en la base de datos
	function GetDuplicate($Telefono) {
		include('config.php');
		$conn->set_charset("utf8");
		$NombreCompletoQuery = "";
		$query = "SELECT * FROM `Telefonos` WHERE `NombreCompleto` = '" . $Telefono . "'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_array($result)){
			$NombreCompletoQuery = $row["NombreCompleto"];
		}
		if ($NombreCompletoQuery == ""){
			$this->DuplicateMatch = "FALSE";
		}
		else {
			$this->DuplicateMatch = "TRUE";
		}
	}

	//Función para insertar el teléfono en la base de datos si no hay duplicado
	function InsertTelefono () {
		include('config.php');
		$conn->set_charset("utf8");
		if ($this->DuplicateMatch == "TRUE"){
			$this->InsertTelefonoResult = "DUPLICATE";
			$this->InsertTelefonoResponse = "El teléfono ingresado ya existe. Sus datos no se agregarán.";
			$this->InsertTelefonoID = "NULL";
		}
		else {
			$InsertTelefono = "INSERT INTO `Telefonos` (`Marca`, `Modelo`, `Variante`, `NombreCompleto`, `LinkReview`, `LTEA`, `HDVoice`, `SAE`) VALUES ('" . mysqli_real_escape_string($conn, $this->Marca) . "', '" . mysqli_real_escape_string($conn, $this->Modelo) . "', '" . mysqli_real_escape_string($conn, $this->Variante) . "', '" . mysqli_real_escape_string($conn, $this->NombreCompleto) . "', '" . mysqli_real_escape_string($conn, $this->LinkReview) . "', '" . mysqli_real_escape_string($conn, $this->LTEA) . "', '" . mysqli_real_escape_string($conn, $this->HDVoice) . "', '" . mysqli_real_escape_string($conn, $this->SAE) . "')" ;
			$Result = mysqli_query($conn, $InsertTelefono);
			if (! $Result){
				$this->InsertTelefonoResult = "ERROR";
				$this->InsertTelefonoResponse = "Ha ocurrido un error al agregar el teléfono.";
				$this->InsertTelefonoID = "NULL";
			}
			else {
				$this->InsertTelefonoResult = "OK";
				$this->InsertTelefonoResponse = "Teléfono agregado correctamente";
				$this->InsertTelefonoID = mysqli_insert_id($conn);
			};
		};
	}
	//Función para insertar el teléfono en la base de datos si no hay duplicado END

	//Función para isertar las bandas del teléfono BEGIN
	function InsertBandas () {

		if ($this->DuplicateMatch == "TRUE"){
			$this->InsertBandasResult = "DUPLICATE";
			$this->InsertBandasResponse = "El teléfono ingresado ya existe. Sus bandas no se agregarán.";

		}
		else {
			include('config.php');
			$InsertBandasQuery = "INSERT INTO `Telefonos_Bandas` (`idTelefonos`, `idBandas`) VALUES ";
			if ($this->GSM1900 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '1'), ";
			}
			else {
			};
			if ($this->GSM900 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '2'), ";
			}
			else {
			};
			if ($this->GSM850 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '3'), ";
			}
			else {
			};
			if ($this->UMTS1900 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '4'), ";
			}
			else {
			};
			if ($this->UMTS850 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '5'), ";
			}
			else {
			};
			if ($this->UMTS900 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '6'), ";
			}
			else {
			};
			if ($this->UMTSAWS == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '7'), ";
			}
			else {
			};
			if ($this->LTE2600 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '8'), ";
			}
			else {
			};
			if ($this->LTE700 == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '9'), ";
			}
			else {
			};
			if ($this->LTEAWS == "TRUE"){
				$InsertBandasQuery = $InsertBandasQuery .  "('" . $this->InsertTelefonoID . "', '10'), ";
			}
			else {
			};

			$InsertBandasQuery = substr($InsertBandasQuery, 0, -2);

			$Result = mysqli_query($conn, $InsertBandasQuery);
			if (! $Result){
					$this->InsertBandasResponse = "Error agregando bandas: " . $InsertBandasQuery;
					$this->InsertBandasResult = "ERROR";
			}
			else {
				$this->InsertBandasResponse = "Bandas agregadas correctamente.";
				$this->InsertBandasResult = "OK";
			};
		}
	}
	//Función para insertar las bandas del teléfono END
}

?>
