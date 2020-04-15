<?php

$type = "Client";
$id = 2;



function affichageMonCompte($type, $id){

	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		if($type == "Vendeur"){
			$sqlVendeur = "SELECT * FROM Vendeur WHERE IdVendeur = $id;";
			$resultVendeur = mysqli_query($db_handle, $sqlVendeur);
			if (mysqli_num_rows($resultVendeur) == 0) { 
			//le livre recherché n'existe pas 
				echo "Pas d'objet trouvé"; 
			}else { 
				$data = mysqli_fetch_assoc($resultVendeur);
				afficheVendeur($data);
			}

		}elseif ($type == "Client") {
			$sqlClient = "SELECT * FROM CLient WHERE IdClient = $id;";
			$resultClient = mysqli_query($db_handle, $sqlClient);
			if (mysqli_num_rows($resultClient) == 0) { 
				//le livre recherché n'existe pas 
				echo "Pas d'objet trouvé"; 
			}else { 
				$data = mysqli_fetch_assoc($resultClient);
				afficheClient($data);
			}

		}		
	}else { 
		echo "Database not found"; 
	}
	//fermer la connexion 
	mysqli_close($db_handle);
}

function afficheVendeur($data){
	echo "Nom:" . $data['Nom'] . '<br>';
	echo "Photo: <img src ='". $data['Photo'] ."'>". '<br>';
	echo "Pays: " . $data['Pays'] . '<br>';
	echo "E mail: " . $data['E-mail'] . '<br>';	
	echo "Telephone: " . $data['Telephone'] . '<br>';
	//tu peux rajouter l'image de fond preferé du vendeur aussi
}

function afficheClient($data){
	echo "Nom:" . $data['Nom'] . '<br>';
	echo "Prenom:" . $data['Prenom'] . '<br>';
	echo "E mail: " . $data['E-mail'] . '<br>';	
	echo "Adresse:" . $data['Adresse'] . '<br>';
	echo "Code Postal: " . $data['CodePostal'] . '<br>';	
	echo "Ville: " . $data['Ville'] . '<br>';		
	echo "Pays: " . $data['Pays'] . '<br>';	
	echo "Telephone :" . $data['Telephone'] . '<br>';

	echo "Infos cb : <br>";		
	echo "Type de Carte: " . $data['TypeCarte'] . '<br>';		
	echo "Nom de la carte: " . $data['NomCarte'] . '<br>';	
	// tu peux ici afficher le numero de carte le code et la date d'expiration
	echo "Porte monnaie :". $data['PorteMonnaie']."<br>";
}

affichageMonCompte($type,$id);

?>