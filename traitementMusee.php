<?php

//identifier votre BDD

$database = "ebayece";
//connectez-vous dans votre BDD

$db_handle = mysqli_connect('localhost', 'root','');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
	$sql = "SELECT * FROM vente WHERE Categorie = 'Bon pour le Musée';";
	$result = mysqli_query($db_handle, $sql);
			//regarder s'il y a de résultat
	if (mysqli_num_rows($result) == 0) {
			//le livre recherché n'existe pas
		echo "Pas d'objet trouvé"; }
		else {
			while ($data = mysqli_fetch_assoc($result)) {
				$IdVendeur = $data['IdVendeur'];
				$sql2 = "SELECT Nom FROM vendeur WHERE IdVendeur=$IdVendeur";
				$result2 = mysqli_query($db_handle, $sql2);
				$data2 = mysqli_fetch_assoc($result2);
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
		}
			//end while
	}else
	{
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);    //end if

	?>
