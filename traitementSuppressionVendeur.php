<?php

function suppressionVendeur($idVendeur){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		$sqlVente ="SELECT * FROM Vente Where idVendeur = $idVendeur;";
		$resultVente = mysqli_query($db_handle, $sqlVente);
		while($dataVente= mysqli_fetch_assoc($resultVente)){
			suppressionVente($dataVente,$db_handle);
		}
		$sqlDelete = "DELETE FROM vendeur WHERE IdVendeur=$idVendeur;";
		mysqli_query($db_handle, $sqlDelete);
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
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

suppressionVendeur($_GET['idvendeur']);
header('Location: viewAdmin.php?supress=1');
exit;
?>
