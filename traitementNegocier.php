<?php


function traitementNegocierVendeur($prixNego, $idVente, $idClient){
	//identifier votre BDD

	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		$sqlNego = "SELECT * FROM Negociation where IdVente = $idVente AND IdClient = $idClient;";
		$resultNego = mysqli_query($db_handle,$sqlNego);
		$data = mysqli_fetch_assoc($resultNego);
		if($data['NbNego']=4){
			echo "vous ne pouvez plus negocier";
		}
		elseif($data['PrixNego']<$prixNego)
			echo "vous ne pouvez pas proposer un prix superieur";
		else{
			$sqladd = "UPDATE Negociation SET PrixNego = $prixNego, NbNego += NbNego WHERE negociation.IdClient = $idClient AND negociation.IdVente = $idVente" ;
			mysqli_query($db_handle, $sqladd);
		}

	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function traitementNegocierClient($prixNego, $idVente, $idUser){
	//identifier votre BDD

	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		$sqlNego = 'SELECT * FROM Negociation where IdVente = $idVente AND IdClient = $idUser';
		$resultNego = mysqli_query($db_handle,$sqlNego);
		$data = mysqli_fetch_assoc($resultNego);
		if($data['NbNego']=4)
			echo "vous ne pouvez plus negocier";
		elseif($data['PrixNego']>$prixNego)
			echo "vous ne pouvez pas proposer un prix inferieur";
		else{
			$sqladd = "UPDATE Negociation SET PrixNego = $prixNego, NbNego += NbNego WHERE negociation.IdClient = $idUser AND negociation.IdVente = $idVente" ;
			mysqli_query($db_handle, $sqladd);
		}

	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

traitementNegocierVendeur(40,2,2);

?>