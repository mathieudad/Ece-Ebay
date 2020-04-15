<?php

function panier($type, $id){
	if($type == "Vendeur" || $type == "Admin"){
		echo "Vous etes un $type vous n'avez pas acces au panier";
		return;
	}

	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
			$sqlPanier = "SELECT Panier FROM Client WHERE IdClient = $id;";
			$resultPanier = mysqli_query($db_handle, $sqlPanier);
			$data = mysqli_fetch_assoc($resultPanier);
			affichePanierDuClient($data, $db_handle);		
	}else { 
		echo "Database not found"; 
	}
	//fermer la connexion 
	mysqli_close($db_handle);
}

function affichePanierDuClient($data,$db_handle){
	$panier = $data['Panier'];
	$tok = strtok($panier,",");

	while ($tok !== false) {
		afficheVenteFavorite($tok,$db_handle);
  		$tok = strtok(",");
	}
	echo "affichage fini";
}

function afficheVenteFavorite($id,$db_handle){
	$sqlFav = "SELECT * FROM Vente WHERE IdVente = $id;";
	$resultFav = mysqli_query($db_handle, $sqlFav);
	$data = mysqli_fetch_assoc($resultFav);
	afficheVente($data);
}

function afficheVente($data){
	$IdVendeur = $data['IdVendeur'];
	$cheminPhoto = $data['Photo'];
	echo '<li class="list-group-item">';
	echo '<div class="media align-items-lg-center flex-column flex-lg-row p-3">';
	echo '<div class="media-body order-2 order-lg-1">';
	echo '<h5 class="mt-0 font-weight-bold mb-2">'.$data['Nom'].'</h5>';
	echo '<p class="font-italic text-muted mb-0 small">'.$data['Description'].'</p>';
	echo '<div class="d-flex align-items-center justify-content-between mt-1">';
	echo '<h6 class="font-weight-bold my-2">'.$data['PrixAchatImmediat'].'€</h6></div>';
	echo"</div><img src='$cheminPhoto'";
	echo 'alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2"></div>  </li>';
}

?>