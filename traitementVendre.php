<?php

function affichageVendre($type, $id){

	if($type == "Client"){
			echo "Cette page est reservée aux achteurs";
			return;
	}
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);
	if ($db_found) {
		$sqlVendeur = "SELECT * FROM Vente WHERE IdVendeur = $id;";
		$resultVendeur = mysqli_query($db_handle, $sqlVendeur);
		if (mysqli_num_rows($resultVendeur) == 0) { 
			//le livre recherché n'existe pas 
			echo "Aucune Vente"; 
		}else { 
			while($data = mysqli_fetch_assoc($resultVendeur)){
				$sql2 = "SELECT Nom FROM vendeur WHERE IdVendeur=$id;";
				$result2 = mysqli_query($db_handle, $sql2);
				$data2 = mysqli_fetch_assoc($result2);
				afficheVenteVendeur($data,$data2);
			}
		}
		
	}else { 
		echo "Database not found"; 
	}
	//fermer la connexion 
	mysqli_close($db_handle);
}


function afficheVenteVendeur($data, $data2){  
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