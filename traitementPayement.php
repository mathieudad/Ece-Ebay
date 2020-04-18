<?php



function paiement($prix,$idClient, $typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
		//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		$sqlClient = "SELECT * FROM client WHERE IdClient = $idClient;";
		$resultClient = mysqli_query($db_handle, $sqlClient);
		$dataClient =  mysqli_fetch_assoc($resultClient);
		if($typeCarte != $dataClient['TypeCarte']){
			return 1;
		}
		elseif($nomCarte != $dataClient['NomCarte']){
			return 2;
		}
		elseif($numeroCarte != $dataClient['NumCarte'] || $dateExpiration != $dataClient['DateExpCarte'] || $codeSecurite != $dataClient['CodeCarte']){
			return 3;
		}

		elseif ($prix > $dataClient['PorteMonnaie']) {
			return 4;
		}
		else{
			$newPorteMonnaie = $dataClient['PorteMonnaie'] - $prix;
			$sqlModifCli = "UPDATE client SET PorteMonnaie= $newPorteMonnaie WHERE client.IdClient = $idClient ";
			$res = mysqli_query($db_handle, $sqlModifCli);
		 	return 5;
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}
?>