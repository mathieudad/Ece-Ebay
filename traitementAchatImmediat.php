<?php


//de plus il faudra verifier les infos de cb

function AchatImmediat($idVente, $idClient){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		traitement($idClient,$idVente,$db_handle);

	}else{
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function traitement($idClient,$idVente,$db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);
	$idVendeur = $dataVente['IdVendeur'];
	$nom = $dataVente['Nom'];
	$photo = $dataVente['Photo'];
	$categorie = $dataVente['Categorie'];
	$prixDepart = $dataVente['PrixDepart'];
	$prixAchat = $dataVente['PrixAchatImmediat'];
	$descrition = $dataVente['Descrition'];

	$sqlHisto = "INSERT INTO `historique` (`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Categorie`, `PrixDepart`, `PrixAchat`, `TypeAchat`, Descrition) VALUES ('$idVente', '$idClient', '$idVendeur', '$nom', '$photo', NULL, '$categorie', '$prixDepart', '$prixAchat', 'Immediat','$descrition');";
	$res = mysqli_query($db_handle, $sqlHisto);

	if($dataVente['TypeVente']=='Negociation'){

		$sqlDeleteNego="DELETE FROM Negociation WHERE IdVente = $idVente";
		mysqli_query($db_handle, $sqlDeleteNego);
	}elseif($dataVente['TypeVente']=='Enchere'){
		$sqlDeleteAutoEnchere="DELETE FROM AutoEnchere WHERE IdVente = $idVente";
		mysqli_query($db_handle, $sqlDeleteAutoEnchere);
		$sqlDeleteEnchere="DELETE FROM Enchere WHERE IdVente = $idVente";
		mysqli_query($db_handle, $sqlDeleteEnchere);
	}
	$sqlDeleteEnchere="DELETE FROM Vente WHERE IdVente = $idVente";
	mysqli_query($db_handle, $sqlDeleteEnchere);
	echo "achat Immediat reussi";
}

AchatImmediat(6,3);


?>