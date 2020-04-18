<?php

function affichageCategorie($mode){

	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		if($mode == "Toutes Categories"){
			$sqlVente = "SELECT * FROM Vente";
			$resultVente = mysqli_query($db_handle, $sqlVente);
			if (mysqli_num_rows($resultVente) == 0) {
				echo "Aucune Vente pour cette categorie";
			}else {
				while($data = mysqli_fetch_assoc($resultVente)){
					afficheVente($data);
				}
			}

		}elseif($mode == "Ferraille ou Tresor"){
			$sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Ferraille ou Tresor';";
			$resultVente = mysqli_query($db_handle, $sqlVente);
			if (mysqli_num_rows($resultVente) == 0) {
				echo "Aucune Vente pour cette categorie";
			}else {
				while($data = mysqli_fetch_assoc($resultVente)){
					afficheVente($data);
				}
			}

		}elseif ($mode =="Bon pour le Musee") {
			$sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Bon pour le Musee';";
			$resultVente = mysqli_query($db_handle, $sqlVente);
			if (mysqli_num_rows($resultVente) == 0) {
				echo "Aucune Vente pour cette categorie";
			}else {
				while($data = mysqli_fetch_assoc($resultVente)){
					afficheVente($data);
				}
			}

		}elseif($mode =="Accessoire VIP"){
			$sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Accessoire VIP';";
			$resultVente = mysqli_query($db_handle, $sqlVente);
			if (mysqli_num_rows($resultVente) == 0) {
				//le livre recherché n'existe pas
				echo "Aucune Vente pour cette categorie";
			}else {
				while($data = mysqli_fetch_assoc($resultVente)){
					afficheVente($data);
				}
			}
		}else echo "categorie non definie";
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function afficheVente($data){
	echo <<< FOOBAR
	<li class="list-group-item">
	<div class="media align-items-lg-center flex-column flex-lg-row p-3">
	<div class="media-body order-2 order-lg-1">
	<a href="viewproduit.php?id={$data['IdVente']}" class="mt-0 font-weight-bold mb-2" style="color:black"> {$data['Nom']}  </a>
	<p class="font-italic text-muted mb-0 small">{$data['Description']}</p>
	<p class="text-muted mb-0 small" style="black">Catégorie de Vente : {$data['TypeVente']}</p>
	<div class="d-flex align-items-center justify-content-between mt-1">
	<h6 class="font-weight-bold my-2">{$data['PrixAchatImmediat']} €</h6></div>
	</div>
	<img src="{$data['Photo']}"alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
	</div>  </li>
	FOOBAR;
}

?>
