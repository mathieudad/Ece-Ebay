<?php


function affichageProduit($idVente, $type){
	//identifier votre BDD
	$database = "ebayece";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','');
	$db_found = mysqli_select_db($db_handle, $database);

	if ($db_found) {
		if($type == 'Admin'){
			traitementAffichageAdmin($idVente,$db_handle);
		}
		elseif($type == 'Vendeur'){
			traitementAffichageVendeur($idVente,$db_handle);

		}elseif($type == 'Client'){
			traitementAffichageClient($idVente,$db_handle);

		}else echo "type invalide";
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function traitementAffichageAdmin($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);

	affichageVenteAdmin($dataVente);

}

function affichageVenteAdmin($dataVente){
	//teste data type de vente et affiche en fonction sachant que c un admin
	echo <<< FOOBAR
	<div class="container">
	<div class="card">
 <div class="row">
   <aside class="col-sm-5 border-right">
 <article class="gallery-wrap">
 <div class="img-big-wrap">
 <div style="object-fit:cover"> <a href="#"><img src="{$dataVente['Photo']}" ></a></div>
 </div>
	</article>
   </aside>
	 <aside class="col-sm-7">
     <article class="card-body p-5">
       <h3 class="title mb-3">{$dataVente['Nom']}</h3>
			 <dl class="item-property">
         <dt>Description</dt>
         <dd><p>{$dataVente['Description']}
				 </dl>
 <dl class="param param-feature">
 <dt>Catégorie</dt>
 <dd>{$dataVente['Categorie']}</dd>
 </dl>
 <dl class="param param-feature">
 <dt>Type de vente</dt>
 <dd>{$dataVente['TypeVente']} ou Vente directe</dd>
 </dl>
	<hr>
 <a href="#" class="btn btn-lg btn-outline-danger text-uppercase"> <i class="fas fa-shopping-cart"></i> Supprimer cet article </a>
FOOBAR;
}

function traitementAffichageVendeur($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);
	affichageVenteVendeur($dataVente);

}

function affichageVenteVendeur($dataVente){
	//teste data type de vente et affiche en fonction sachant que c un vendeur
	echo <<< FOOBAR
	<div class="container">
	<div class="card">
 <div class="row">
	 <aside class="col-sm-5 border-right">
 <article class="gallery-wrap">
 <div class="img-big-wrap">
 <div style="object-fit:cover"> <a href="#"><img src="{$dataVente['Photo']}" ></a></div>
 </div>
	</article>
	 </aside>
	 <aside class="col-sm-7">
		 <article class="card-body p-5">
			 <h3 class="title mb-3">{$dataVente['Nom']}</h3>
			 <dl class="item-property">
				 <dt>Description</dt>
				 <dd><p>{$dataVente['Description']}
				 </dl>
 <dl class="param param-feature">
 <dt>Catégorie</dt>
 <dd>{$dataVente['Categorie']}</dd>
 </dl>
 <dl class="param param-feature">
 <dt>Type de vente</dt>
 <dd>{$dataVente['TypeVente']} ou Vente directe</dd>
 </dl>
FOOBAR;
}

function traitementAffichageClient($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVente= $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);
	affichageVenteClient($dataVente,$db_handle);

}

function affichageVenteClient($dataVente,$db_handle){
	//teste data type de vente et affiche en fonction sachant que c un client
	$idVente=$dataVente['IdVente'];
	echo <<< FOOBAR
	<div class="container">
	<div class="card">
 <div class="row">
   <aside class="col-sm-5 border-right">
 <article class="gallery-wrap">
 <div class="img-big-wrap">
 <div style="object-fit:cover"> <a href="#"><img src="{$dataVente['Photo']}" ></a></div>
 </div>
	</article>
   </aside>
	 <aside class="col-sm-7">
     <article class="card-body p-5">
       <h3 class="title mb-3">{$dataVente['Nom']}</h3>
			 <dl class="item-property">
         <dt>Description</dt>
         <dd><p>{$dataVente['Description']}
				 </dl>
 <dl class="param param-feature">
 <dt>Catégorie</dt>
 <dd>{$dataVente['Categorie']}</dd>
 </dl>
 <dl class="param param-feature">
 <dt>Type de vente</dt>
 <dd>{$dataVente['TypeVente']} ou Vente directe</dd>
 </dl>
	<hr>
 <dl class="param param-feature">
 <dt>Prix d'achat immédiat</dt>
 </dl>
	<p class="price-detail-wrap">
 <span class="price h3 text-warning">
   <span class="currency">EUR €</span><span class="num">{$dataVente['PrixAchatImmediat']} </span>
 </span>
	</p>
 <a href="#" class="btn btn-lg btn-outline-dark text-uppercase"> <i class="fas fa-shopping-cart"></i> Ajouter au panier </a> <a href="#" class="btn btn-lg btn-outline-danger text-uppercase"> <i class="fas fa-shopping-cart"></i> Achat Immediat</a>
FOOBAR;

 if($dataVente['TypeVente']=="Enchere")
 {
	 $sql = "SELECT * FROM enchere WHERE IdVente = $idVente;";
	 $result = mysqli_query($db_handle, $sql);

	 if (mysqli_num_rows($result) != 0) $data = mysqli_fetch_assoc($result);

	 echo <<< FOOBAR
	 <hr>
	 <dl class="param param-feature">
	 <dt>Prix de départ</dt>
	 </dl>
	 <p class="price-detail-wrap">
	 <span class="price h3 text-warning">
	   <span class="currency">EUR €</span><span class="num">{$dataVente['PrixDepart']}</span>
	 </span>
	FOOBAR;

		 if (mysqli_num_rows($result) != 0){
			 echo <<< FOOBAR
			 <hr>
			 <dl class="param param-feature">
			 <dt>Prix Actuel/dt>
			 </dl>
			 <p class="price-detail-wrap">
			 <span class="price h3 text-warning">
			   <span class="currency">EUR €</span><span class="num">{$data['PrixActuel']}</span>
			 </span>
			FOOBAR;

		 }
	echo <<< FOOBAR
	 </p>
	 <a href="#" class="btn btn btn-outline-dark text-uppercase"> <i class="fas fa-shopping-cart"></i> Faire une offre d'enchere</a>
	 </article>
	   </aside>
	 </div>
	 </div>
	 </div>
	FOOBAR;
}

if($dataVente['TypeVente']=="Negociation"){



	echo <<< FOOBAR
	<hr>
		 <dl class="param param-feature">
		 <dt>Prix de départ</dt>
		 </dl>
		 <p class="price-detail-wrap">
		 <span class="price h3 text-warning">
		   <span class="currency">EUR €</span><span class="num">{$dataVente['PrixDepart']}</span>
		 </span>
	 </p>
	 <hr>
	 <dl class="param param-feature">
	 <dt>Négociation</dt>
	 </dl>
	 <a href="#" class="btn btn btn-outline-dark text-uppercase"> <i class="fas fa-shopping-cart"></i> Proposer une négociation</a>
	 </article>
		 </aside>
	 </div>
	 </div>
	 </div>
	FOOBAR;
}




}


?>
