<?php


function affichage($type)
{
	if($type == 'Admin' || $type == 'Client')
		echo "Vous ne pouvez pas ajouter de vente";
	else{
		echo <<< FOOBAR
		<form action="traitementAjoutVente.php" method="post" enctype="multipart/form-data">
		<?php
		$error=isset($_GET["error"])? $_GET["error"] : "";
		if($error==1)
		echo '<div class="title mb-2" style="color:red;font-size:200%"> Vente Invalide </div>';
		if($error==2)
		echo '<div class="title mb-2" style="color:red;font-size:200%"> Type de photo invalide </div>';
		else echo '<div class="title mb-2"> Veuillez entrer une vente </div>';
		?>
		<div class="input-group mb-3">
		<input type="text" name="Nom" class="form-control input_user" placeholder="Nom du produit" >
		</div>
		<div class="input-group mb-1">
		<div class="input-group-append">
		<td > Catégorie <br></td>
		</div>
		<td class="ml-auto">
		<select class="form-control ml-2 mb-2 " name="Categorie" size="1">
		<option>Ferraille ou Tresor</option>
		<option>Bon pour le Musee</option>
		<option>Accessoire VIP</option>
		</select> </td>
		</div>
		<div class="form-group">
		<textarea class="form-control rounded-1" name="Description"placeholder="Description du produit" rows="4"></textarea>
		</div>
		<div class="input-group mb-1">
		<div class="input-group-append">
		<td> Type de vente <br></td>
		</div>
		<td class="ml-auto">
		<select class="form-control ml-2 mb-2" name="TypeVente" size="1">
		<option>Negociation</option>
		<option>Enchere</option>
		</select> </td>
		</div>
		<div class="input-group mb-3">
		<input type="number" name="PrixDepart" class="form-control input_user" placeholder="Prix de départ">
		</div>
		<div class="input-group mb-3">
		<input type="number" name="PrixAchatImmediat" class="form-control input_user" placeholder="Prix d'achat immediat">
		</div>
		<div class="input-group mb-3">
		<table>
		<tr>
		<td><label class = "mr-2"> Date de fin de la vente :</label></td>
		<td><input type="date" name="DateFin" class="form-control input_user" placeholder="Date de fin"></td>
		</tr>
		</table>
		</div>
		<hr>
		<div class="input-group mb-3">
		<table>
		<tr>
		<td>Image 1 du produit : </td>
		<td><input type="file" name="image"></td>
		</tr>
		<br>
		<tr>
		<td>Image 2 du produit :</td>
		<td><input type="file" name="image2"></td>
		</tr>
		<br>
		<tr>
		<td>Image 3 du produit :</td>
		<td><input type="file" name="image3"></td>
		</tr>
		<br>
		<tr>
		<td>Vidéo du produit :</td>
		<td><input type="file" name="vidéo"></td>
		</tr>
		</table>
		</div>
		<div class="d-flex  mt-3 mb-5 login_container">
		<input type="submit" class="btn btn-outline-dark" style="text-transform : uppercase" value="Ajouter Cette vente">
		</div>
		</form>
		</div>
		</div>
		</div>
		</div>
		<br>
		FOOBAR;
	}
}


?>