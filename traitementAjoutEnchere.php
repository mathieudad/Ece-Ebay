<?php


function ajoutEnchere($prix, $idVente, $idClient){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		//on regarde si il y a deja une enchere 
		//si non 
			//test que le prix soit superieur au prix depart si non erreur
			//si oui on cree une enchere
		//si oui  
			//test que le prix soit superieur au prix actuel si non erreur
			//si oui on change l'enchere idclient et prix 
			//test si il y a une enchere max 
				// si elle est inferieure au prix on la supprime
				// si elle est superieur au prix on change l'enchere id client et prix

		$sqlEnchere = "SELECT * FROM Enchere WHERE IdVente = $idVente;";
		$resultEnchere = mysqli_query($db_handle, $sqlEnchere);
		if (mysqli_num_rows($resultEnchere) == 0){ 
			nouvelleEnchere($idVente,$idClient,$prix,$db_handle);
		}else{
			$data = mysqli_fetch_assoc($resultEnchere);
			modifEnchere($idVente,$idClient,$prix,$db_handle,$data);
			$sqlAutoEnchere = "SELECT * FROM Autoenchere WHERE IdVente = $idVente;";
			$resultAutoEnchere = mysqli_query($db_handle, $sqlAutoEnchere);
			if (mysqli_num_rows($resultEnchere) > 0){
				$data2 = mysqli_fetch_assoc($resultAutoEnchere);
				modifAutoEnchere($idVente,$prix,$data2,$db_handle); 
			}
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function nouvelleEnchere($idVente,$idClient,$prix,$db_handle){
	$sqlVente = "SELECT PrixDepart,PrixAchatImmediat FROM Vente WHERE IdVente = $idVente";
	$resultVente = mysqli_query($db_handle,$sqlVente);
	$data = mysqli_fetch_assoc($resultVente);
	if($data['PrixDepart']> $prix || $data['PrixAchatImmediat']<= $prix)
		echo "Vous ne pouvez pas entrer ce prix!";
	else{
		$sqlNewEnchere = "INSERT INTO enchere (IdVente, IdClient,PrixActuel) VALUES ('$idVente', '$idClient', '$prix')";
		$res = mysqli_query($db_handle, $sqlNewEnchere);
		if($res == false){
			echo "error creation enchere";
			return;
		}
		echo "creation de l'enchere";
	}
}


function modifEnchere($idVente,$idClient,$prix,$db_handle,$data){
	$sqlVente = "SELECT PrixAchatImmediat FROM Vente WHERE IdVente = $idVente";
	$resultVente = mysqli_query($db_handle,$sqlVente);
	$data2 = mysqli_fetch_assoc($resultVente);
	if($data['PrixActuel']> $prix || $data2['PrixAchatImmediat']<= $prix)
		echo "Vous ne pouvez pas entrer ce prix!";
	else{
		$sqlModifEnchere = "UPDATE enchere SET IdClient = $idClient, PrixActuel = $prix WHERE enchere.IdVente = $idVente ";
		$res = mysqli_query($db_handle, $sqlModifEnchere);
		if($res == false){
			echo "error creation enchere";
			return;
		}
		echo "modification de l'enchere";
	}
}

function modifAutoEnchere($idVente,$prix,$data,$db_handle){
	if($data['PrixMax']<= $prix){
		$sqlDelete = "DELETE FROM autoenchere WHERE IdVente = $idVente"; 
   	// Exécution de la requête 
		$resultat = mysqli_query($db_handle, $sqlDelete); 
		if ($resultat == FALSE) { 
			echo "error suppression"; 
		} 
		return;
	}
	$newPrix = $prix+1;
	$maxClient = $data['IdClient'];
	$sqlModifEnchere = "UPDATE enchere SET IdClient = $maxClient, PrixActuel = $newPrix WHERE enchere.IdVente = $idVente";
	$res = mysqli_query($db_handle, $sqlModifEnchere);
	if($res == false){
		echo "error creation enchere";
		return;
	}
	echo "modification de l'enchere";
}
?>