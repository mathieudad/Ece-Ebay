<?php


//$type = isset($_POST["Type"])? $_POST[""] : ""; 
//$numeroCarte = isset($_POST[""])? $_POST[""] : ""; 
//$nomCarte = isset($_POST[""])? $_POST[""] : ""; 
//$dateExpiration = isset($_POST[""])? $_POST[""] : ""; 
//$codeSecurite = isset($_POST[""])? $_POST[""] : "";

function validerNegoClient($idClient,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		valider($idClient,$db_handle,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function validerClient($idClient,$db_handle,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	include 'traitementPayement.php';
	$sqlNego ="SELECT * FROM Negociation Where IdClient = $idClient;";
	$resultNego = mysqli_query($db_handle, $sqlNego);
	$dataNego =  mysqli_fetch_assoc($resultNego);	
	$retourTraitement = traitementPayement($dataNego['PrixNego'],$idClient,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);
	if($retourTraitement==4){
		$idVente = $dataNego['IdVente'];
		$sqlVente = "SELECT * FROM Vente Where IdVente = $idVente;";
		$resultVente = mysqli_query($db_handle, $sqlVente);
		$dataVente =  mysqli_fetch_assoc($resultVente);
		addHistorique($dataVente,$dataNego,$db_handle);
		suppressionVente($dataVente,$db_handle);
	else{
			echo "soucis";
			//reafficher la page de payement avec l'erreur associé 
		}
	}
	
}

function addHistorique($dataVente,$dataNego,$db_handle){
	$idVente = $dataVente['IdVente'];
	$idVendeur = $dataVente['IdVendeur'];
	$idClient = $dataNego['IdClient'];
	$nom = $dataVente['Nom'];
	$photo = $dataVente['Photo'];
	$categorie = $dataVente['Categorie'];
	$prixDepart = $dataVente['PrixDepart'];
	$prixAchat = $dataNego['PrixNego'];
	$description = $dataVente['Description'];

	$sqlHisto = "INSERT INTO `historique` (`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Categorie`, `PrixDepart`, `PrixAchat`, `TypeAchat`, Description) VALUES ('$idVente', '$idClient', '$idVendeur', '$nom', '$photo', NULL, '$categorie', '$prixDepart', '$prixAchat', 'Negociation', '$description');";
	$res = mysqli_query($db_handle, $sqlHisto);
}


function suppressionVente($dataVente,$db_handle){
	$idVente = $dataVente['IdVente'];
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
}




?>