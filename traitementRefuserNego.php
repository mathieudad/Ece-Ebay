<?php

function refuserNego($idClient,$idVente){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		refuser($idClient,$db_handle,$idVente);
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function refuser($idClient,$db_handle,$idVente){
	$sqlNego ="DELETE FROM Negociation Where IdClient = $idClient AND IdVente= $idVente ";
	mysqli_query($db_handle, $sqlNego);
}

refuserNego($_GET['IdClient'],$_GET['idvente']);
header('Location: viewachats.php?result=6');
exit;


?>
