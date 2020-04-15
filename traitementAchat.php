<?php

function affichageAchat($type, $id){

	if($type == "Vendeur"){
			echo "Cette page est reservée aux achteurs";
			return;
	}
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);
	if ($db_found) {
		$sqlClient = "SELECT * FROM Historique WHERE IdClient = $id;";
		$resultClient = mysqli_query($db_handle, $sqlClient);
		if (mysqli_num_rows($resultClient) == 0) { 
			//le livre recherché n'existe pas 
			echo "Aucun achat"; 
		}else { 
			while($data = mysqli_fetch_assoc($resultClient)){
				afficheHistoClient($data);
			}
		}
		
	}else { 
		echo "Database not found"; 
	}
	//fermer la connexion 
	mysqli_close($db_handle);
}


function afficheHistoClient($data){
	echo "Nom:" . $data['Nom'] . '<br>';
	echo "Photo:" . $data['Photo'] . '<br>';
	echo "Catégorie: " . $data['Categorie'] . '<br>';	
	echo "Prix de Depart:" . $data['PrixDepart'] . '<br>';
	echo "Prix d'achat : " . $data['CodePostal'] . '<br>';	
	echo "Type d'Achat: " . $data['TypeAchat'] . '<br>';
}

?>