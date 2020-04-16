<?php


function affichageNego($id, $type){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		if($type == 'Admin')
			echo "Vous n'avez pas de nego vous etes admin";
		//on regarde si le client a deja fait une nego si oui on quitte
		//si non on cree la nego 
		elseif($type == 'Vendeur'){
			traitementAffichageVendeur($id,$db_handle);

		}elseif($type == 'Client'){
			traitementAffichageClient($id,$db_handle);

		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function traitementAffichageVendeur($id,$db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVendeur = $id;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	if( mysqli_num_rows($resultVente) == 0){
		echo "Vous n'avez pas de ventes donc pas de Nego";
		return;
	}
	while($dataVente = mysqli_fetch_assoc($resultVente)){
		if($dataVente['TypeVente'] == 'Negociation'){
			$vente = $dataVente['IdVente'];
			$sqlNego = "SELECT * FROM Negociation WHERE IdVente = $vente;";
			$resultNego = mysqli_query($db_handle, $sqlNego);
			$dataNego =  mysqli_fetch_assoc($resultNego);

			$sqlVentedeNego = "SELECT * FROM Vente WHERE IdVente = $vente;";
			$resultVentedeNego = mysqli_query($db_handle, $sqlVentedeNego);
			if(mysqli_num_rows($resultVentedeNego) != 0){
				$dataVentedeNego =  mysqli_fetch_assoc($resultVentedeNego);
				$aQui = aQuiLeTour($dataNego);
				affichageNegoCoteVendeur($dataNego, $dataVentedeNego, $aQui);
			}
		}
	}
}

function affichageNegoCoteVendeur($dataNego,$dataVenteAssocie,$aQuiLeTour)
{

	echo "$aQuiLeTour".'<br>';
	echo "idVente:" . $dataVenteAssocie['IdVente'] . '<br>';
	echo "idNego:" . $dataNego['IdVente'] . '<br>';
	echo "prix:" . $dataNego['PrixNego'] . '<br>';
}


function traitementAffichageClient($id,$db_handle)
{
	$sqlNego = "SELECT * FROM Negociation WHERE IdClient = $id;";
	$resultNego = mysqli_query($db_handle, $sqlNego);
	if(mysqli_num_rows($resultNego)==0){
		echo "Vous n'avez pas fait d'offre de Negociation";
	}else{
		while($dataNego =  mysqli_fetch_assoc($resultNego)){
			$idVente = $dataNego['IdVente'];
			$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
			$resultVente = mysqli_query($db_handle, $sqlVente);
			$dataVenteAssocie = mysqli_fetch_assoc($resultVente);
			$aQui = aQuiLeTour($dataNego);
			affichageNegoCoteClient($dataNego,$dataVenteAssocie,$aQui);
		}
	}
}

function affichageNegoCoteClient($dataNego,$dataVenteAssocie,$aQuiLeTour){
	echo "$aQuiLeTour".'<br>';
	echo "idVente:" . $dataVenteAssocie['IdVente'] . '<br>';
	echo "idNego:" . $dataNego['IdVente'] . '<br>';
	echo "prix:" . $dataNego['PrixNego'] . '<br>';
}

function aQuileTour($dataNego){
	$nbNego = $dataNego['NbNego'];
	if($nbNego%2 == 0)
		return 'Vendeur';
	else return 'Client;';
}

?>