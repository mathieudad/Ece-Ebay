<?php


function ajoutPanier($idClient, $idVente){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);


	if ($db_found) {
		$sqlpanier = "SELECT Panier FROM client WHERE IdClient = $idClient;";
		$resultpanier = mysqli_query($db_handle, $sqlpanier);
		$data = mysqli_fetch_assoc($resultpanier);
		if($data['Panier']==null){
			$sqlnull = "UPDATE client SET Panier = '$idVente' WHERE client.IdClient = $idClient";
				mysqli_query($db_handle, $sqlnull);
		}
		else{
			if(verifPanier($data,$idVente)){
				$panier = $data['Panier'].',' . $idVente;
				$sqladd = "UPDATE client SET Panier = '$panier' WHERE client.IdClient = $idClient";
				mysqli_query($db_handle, $sqladd);
			}	
		} 
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function verifPanier($data,$idVente){
	$panier = $data['Panier'];
	$tok = strtok($panier,",");

	while ($tok != false) {
		if($tok == $idVente)
			return false;
  		$tok = strtok(",");
	}
	return true;
}

?>