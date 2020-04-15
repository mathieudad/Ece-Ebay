<?php

function panier($type, $id){
	if($type == "Vendeur" || $type == "Admin"){
		echo "Vous etes un $type vous n'avez pas acces au panier"; //dans un beau message
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
	$total=0;
	$panier = $data['Panier'];
	$tok = strtok($panier,",");

	while ($tok !== false) {
		$total=afficheVenteFavorite($tok,$db_handle,$total);
  		$tok = strtok(",");

	}

	echo <<<FOOBAR
	<tr>
			<td>   </td>
			<td>   </td>
			<td>   </td>
			<td><h3 class="text-center">Total</h3></td>
			<td class="text-right"><h3> {$total} €</h3></td>
	</tr>
	FOOBAR;
}

function afficheVenteFavorite($id,$db_handle,$total){
	$sqlFav = "SELECT * FROM Vente WHERE IdVente = $id;";
	$resultFav = mysqli_query($db_handle, $sqlFav);
	$data = mysqli_fetch_assoc($resultFav);
	$total+=$data['PrixAchatImmediat'];
	afficheVente($data);
	return $total;
}

function afficheVente($data){

	echo <<< FOOBAR
		<tr>
				<td class="col-sm-8 col-md-6">
				<div class="media">
						<a class="thumbnail pull-left" href="#"> <img class="media-object" src="{$data['Photo']} " style="width: 72px; height: 72px;"> </a>
						<div class="media-body ">
								<h5 class="mt-0 font-weight-bold mb-2 ml-2"> <a style="color:black" href="produit.php?id={$data['IdVente']}">{$data['Nom']}</a></h5>
							<h6 class="mt-0 font-weight-bold mb-2 ml-2"> Vendeur : <a style="color:black" href="#">Nom du vendeur</a></h6>
							</div>
			</div></td>
			<td> </td>
			<td> </td>
			<td class="col-sm-1 col-md-1 text-center"><strong>{$data['PrixAchatImmediat']}€ </strong></td>
			<td class="col-sm-1 col-md-1">
			<button type="button" class="btn btn-danger">
					<span class="glyphicon glyphicon-remove"></span> Supprimer cet article
			</button></td>
	</tr>
	FOOBAR;
}
?>
