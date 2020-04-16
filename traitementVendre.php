<?php

function affichageVendre($type, $id){

	if($type == "Client" || $type == "Admin"){
			echo "Vous etes $type, cette page est reservée aux vendeurs";
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

	echo <<< FOOBAR
	<a href="viewproduit.php?id={$data['IdVente']}" style="text-decoration: none;">
	<div class="border-card">
 <img src="{$data['Photo']}"class="img-thumbnail" width=100px height=100px>
  <div class="content-wrapper">
  <div class="label-group fixed">
  <p class="caption ml-5">Nom du produit</p>
  <p class="title ml-5">{$data['Nom']}</p>
  </div>
  <div class="min-gap"></div>
  <div class="label-group">
  <p class="caption">Type de Vente</p>
  <p class="title">{$data['TypeVente']}</p>
  </div>
	<div class="min-gap"></div>
  <div class="label-group">
  <p class="caption">Catégorie</p>
  <p class="title">{$data['Categorie']}</p>
  </div>
  <div class="min-gap"></div>
  <div class="label-group">
  <p class="caption">Prix d'achat immediat</p>
  <p class="title">{$data['PrixAchatImmediat']}€</p>
  </div>
</div>
</div>
</a>
FOOBAR;
}

?>
