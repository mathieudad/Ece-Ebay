<?php


//$type = isset($_POST["Type"])? $_POST[""] : ""; 
//$numeroCarte = isset($_POST[""])? $_POST[""] : ""; 
//$nomCarte = isset($_POST[""])? $_POST[""] : ""; 
//$dateExpiration = isset($_POST[""])? $_POST[""] : ""; 
//$codeSecurite = isset($_POST[""])? $_POST[""] : "";



function payement($prix,$idClient, $typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
		//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		$sqlClient = "SELECT *FROM client WHERE IdClient = $idClient;";
		$resultClient = mysqli_query($db_handle, $sqlClient);
		$dataClient =  mysqli_fetch_assoc($resultClient);
		if($typeCarte != $dataClient['TypeCarte']){
			echo "typeCarte incorrect";
			return 0;
		}
		elseif($nomCarte != $dataClient['NomCarte']){
			echo "nomCarte incorrect";
			return 1;;
		}
		elseif($numeroCarte != $dataClient['NumCarte'] || $dateExpiration != $dataClient['DateExpCarte'] || $codeSecurite != $dataClient['CodeCarte']){
			echo"infoperso incorrect";
			return 2;;
		}

		elseif ($prix > $dataClient['PorteMonnaie']) {
			echo "fond insuffisant";
			return 3;
		}
		else{
			$newPorteMonnaie = $dataClient['PorteMonnaie'] - $prix;
			$sqlModifCli = "UPDATE client SET PorteMonnaie= $newPorteMonnaie WHERE client.IdClient = $idClient ";
			$res = mysqli_query($db_handle, $sqlModifCli);
		 	return 4;
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

payement(10,1,'Visa','1234123412341234','Bart Simpson','12/2020',123);

?>