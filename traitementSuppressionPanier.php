<?php


function suppressionPanier($idClient, $idVente){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);


	if ($db_found) {
		$sqlpanier = "SELECT Panier FROM client WHERE IdClient = $idClient;";
		$resultpanier = mysqli_query($db_handle, $sqlpanier);
		$data = mysqli_fetch_assoc($resultpanier);
		$string = $data['Panier'];
		$panier = suppressionString($string,$idVente);
		if($panier == 'null'){
			$sqladd = "UPDATE client SET Panier = NULL WHERE client.IdClient = $idClient";
			mysqli_query($db_handle, $sqladd);
		}else{
			$sqladd = "UPDATE client SET Panier = '$panier' WHERE client.IdClient = $idClient";
			mysqli_query($db_handle, $sqladd);
		}

	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function suppressionString($string,$idVente){

	if($string == $idVente){
		$string = 'null';
		return $string;
	}
	else{
		$string = 'o'. $string .'o';
		$remplace = 'o'.$idVente.',';
		$string = str_replace($remplace,'', $string);
		$remplace1 = ','.$idVente.',';
		$string = str_replace($remplace1,',', $string);
		$remplace2 = ','.$idVente.'o';
		$string = str_replace($remplace2,'', $string);
		$string = str_replace('o', '', $string);
	}
	return $string;
}

session_start();
suppressionPanier($_SESSION['Id'],$_GET['idvente']);
header('Location:viewpanier.php');
exit;

?>
