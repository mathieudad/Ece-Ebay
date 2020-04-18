<?php 



function vente($idVendeur,$nom,$description,$categorie,$prixDepart,$prixAchatImmediat,$typeVente,$datefin){
	if(isset($_FILES["image"]))
	{ 
		$dossier = 'PhotoItem/';
		$fichier = basename($_FILES['image']['name']);
		$photo = $dossier.$fichier;
		move_uploaded_file($_FILES['image']['tmp_name'], $photo); 
	}
	else{
		header('Location: ajoutVente.php?error=2');
		exit;
	}

	if($nom=="" || $description=="" || $categorie=="" || $prixDepart=="" || $prixAchatImmediat=="" || $typeVente=="" || $datefin=="" || $datefin < date('Y-m-d')){

  		header('Location: ajoutVente.php?error=1');
		exit;
	}else{
		ajoutVente($idVendeur,$nom,$description,$categorie,$prixDepart,$prixAchatImmediat,$typeVente,$datefin,$photo);
		header('Location: viewVentes.php?result=1');
	}
}

function ajoutVente($idVendeur,$nom,$description,$categorie,$prixDepart,$prixAchatImmediat,$typeVente,$datefin,$photo){

	$database = "ebayece";

  //connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost','root','');
	$db_found = mysqli_select_db($db_handle, $database);
	$dateToday = date('Y-m-d'); 
	$sqlVente = "INSERT INTO `vente`(`IdVente`,`IdVendeur`, `Nom`, `Photo`, `Video`, `Description`, `Categorie`, `PrixDepart`, `PrixAchatImmediat`, `TypeVente`, `DateAjout`, `DateFin`) VALUES (NULL,'$idVendeur','$nom','$photo',NULL,'$description','$categorie','$prixDepart','$prixAchatImmediat','$typeVente','$dateToday','$datefin')";
	$res = mysqli_query($db_handle, $sqlVente);

	mysqli_close($db_handle);

}


session_start();
$nom = isset($_POST["Nom"])? $_POST["Nom"] : ""; 
$description = isset($_POST["Description"])? $_POST["Description"] : "";
$categorie = isset($_POST["Categorie"])? $_POST["Categorie"] : ""; 
$prixDepart = isset($_POST["PrixDepart"])? $_POST["PrixDepart"] : "";
$prixAchatImmediat = isset($_POST["PrixAchatImmediat"])? $_POST["PrixAchatImmediat"] : "";
$typeVente = isset($_POST["TypeVente"])? $_POST["TypeVente"] : ""; 
$datefin = isset($_POST["DateFin"])? $_POST["DateFin"] : "";
vente($_SESSION['Id'],$nom,$description,$categorie,$prixDepart,$prixAchatImmediat,$typeVente,$datefin);

?>