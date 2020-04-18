<?php


function aPayer($id, $type){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		if($type == 'Client'){
			traitementAffichageClient($id,$db_handle);

		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function traitementAffichageClient($id,$db_handle)
{
	$sqlNego = "SELECT * FROM apayer WHERE IdClient = $id;";
	$resultAPayer = mysqli_query($db_handle, $sqlNego);
	if(mysqli_num_rows($resultAPayer)!=0){
		while($dataAPayer =  mysqli_fetch_assoc($resultAPayer)){
			affichageAPayer($dataAPayer);
		}
	}
}

function affichageAPayer($dataAPayer){
		echo <<< FOOBAR
		<div class="border-card">
		<img src="{$dataAPayer['Photo']}"class="img-thumbnail" width=100px height=100px>
		<div class="content-wrapper">
		<div class="label-group fixed">
		<p class="caption ml-4">Nom du produit</p>
		<p class="title ml-4">{$dataAPayer['Nom']}</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix de Départ </p>
		<p class="title">{$dataAPayer['PrixDepart']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix à payer </p>
		<p class="title">{$dataAPayer['PrixAchat']}€</p>
		</div>
		<div class="min-gap"></div>
		<form action="paiementAPayer.php?idvente={$dataAPayer['IdVente']}" method="post">
		<input type="submit" class="btn btn-outline-success text-uppercase" value="Procéder au paiement">
		</form>
		</div>
		</div>
		FOOBAR;
}



?>
