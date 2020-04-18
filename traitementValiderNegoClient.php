<?php

function validerNegoClient($idClient, $idVente, $typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		valider($idClient, $idVente, $db_handle,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function validerClient($idClient,$idVente,$db_handle,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	include 'traitementPayement.php';
	$sqlNego ="SELECT * FROM Negociation Where IdClient = $idClient AND IdVente = $idVente;";
	$resultNego = mysqli_query($db_handle, $sqlNego);
	$dataNego =  mysqli_fetch_assoc($resultNego);	
	$retourTraitement = traitementPayement($dataNego['PrixNego'],$idClient,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);
	if($retourTraitement==5){
		$sqlVente = "SELECT * FROM Vente Where IdVente = $idVente;";
		$resultVente = mysqli_query($db_handle, $sqlVente);
		$dataVente =  mysqli_fetch_assoc($resultVente);
		addHistorique($dataVente,$dataNego,$db_handle);
		suppressionVente($dataVente,$db_handle);
		return $retourTraitement;
	else{
			return $retourTraitement;
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


session_start();
$type = isset($_POST["TypeCarte"])? $_POST["TypeCarte"] : ""; 
$numeroCarte = isset($_POST["NumCarte"])? $_POST["NumCarte"] : ""; 
$nomCarte = isset($_POST["NomCarte"])? $_POST["NomCarte"] : ""; 
$dateExpiration = isset($_POST["DateExpCarte"])? $_POST["DateExpCarte"] : ""; 
$codeSecurite = isset($_POST["CodeCarte"])? $_POST["CodeCarte"] : "";

$retour = validerNegoClient($_SESSION['Id'],$_GET['IdVente'],$type,$numeroCarte,$nomCarte,$dateExpiration,$codeSecurite);
if($retour == 5)
	header('Location: viewachats.php?id='.$_GET['&result='].$retour);
else 
	header('Location: paiement.php?id='.$_GET['idvente'].$_GET['&error='.$retour);
exit;
?>