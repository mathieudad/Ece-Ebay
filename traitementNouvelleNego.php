<?php


function ajoutNego($prixNego, $idVente, $idClient){
	//identifier votre BDD
	$database = "ebayece";
	$finnego;

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		//on regarde si le client a deja fait une nego si oui on quitte
		//si non on cree la nego

		$sqlEnchere = "SELECT * FROM Negociation WHERE IdVente = $idVente AND IdClient = $idClient;";
		$resultEnchere = mysqli_query($db_handle, $sqlEnchere);
		if (mysqli_num_rows($resultEnchere) == 0){
			$finnego = nouvelleNego($idVente,$idClient,$prixNego,$db_handle);
		}else{
				echo "vous avez deja proposé une Negociation";
				$finnego=2;
		}
	}else{
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
	return $finnego;
}


function nouvelleNego($idVente,$idClient,$prixNego,$db_handle){
	$sqlVente = "SELECT PrixDepart,PrixAchatImmediat FROM Vente WHERE IdVente = $idVente";
	$resultVente = mysqli_query($db_handle,$sqlVente);
	$data = mysqli_fetch_assoc($resultVente);
	if($data['PrixDepart']> $prixNego || $data['PrixAchatImmediat']<= $prixNego){
		echo "Vous ne pouvez pas entrer ce prix!";
		return 2;
	}
	else{
		$sqlNewEnchere = "INSERT INTO Negociation (IdVente, IdClient, NbNego, PrixNego) VALUES ('$idVente', '$idClient', '0', '$prixNego')";
		$res = mysqli_query($db_handle, $sqlNewEnchere);
		if($res == false){
		//	echo "error creation Negociation";
			return;
		}
		echo "creation de la nego";
		return 1;
	}
}

session_start();
$prix = isset($_POST["prix"])? $_POST["prix"] : "";
$finnego = ajoutnego($prix,$_GET['idvente'],$_SESSION['Id']);
header('Location: viewproduit.php?id='.$_GET['idvente'].'&nego='.$finnego);
exit;

?>
