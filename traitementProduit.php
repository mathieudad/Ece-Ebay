<?php


function affichageProduit($idVente, $type){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		if($type == 'Admin'){
			traitementAffichageAdmin($idVente,$db_handle);
		}
		elseif($type == 'Vendeur'){
			traitementAffichageVendeur($idVente,$db_handle);

		}elseif($type == 'Client'){
			traitementAffichageClient($idVente,$db_handle);

		}else echo "type invalide";
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function traitementAffichageAdmin($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVendeur = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);

	affichageVenteAdmin($dataVente);

}

function affichageVenteAdmin($dataVente){
	//teste data type de vente et affiche en fonction sachant que c un admin 
	echo "Nom :".$dataVente['Nom'].'<br>';
	echo "vente admin";
}

function traitementAffichageVendeur($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVendeur = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);
	affichageVenteVendeur($dataVente);

}

function affichageVenteVendeur($dataVente){
	//teste data type de vente et affiche en fonction sachant que c un vendeur 
	echo "Nom :".$dataVente['Nom'].'<br>';
	echo "vente vendeur";
}

function traitementAffichageClient($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVendeur = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);
	affichageVenteClient($dataVente);

}

function affichageVenteClient($dataVente){
	//teste data type de vente et affiche en fonction sachant que c un client 
	echo "Nom :".$dataVente['Nom'].'<br>';
	echo "vente client";
}

?>