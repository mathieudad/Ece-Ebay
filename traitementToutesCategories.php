<?php

//identifier votre BDD

$database = "ebayece";
//connectez-vous dans votre BDD

$db_handle = mysqli_connect('localhost', 'root','');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
	$sql = "SELECT * FROM vente;";
	$result = mysqli_query($db_handle, $sql);
			//regarder s'il y a de résultat 
	if (mysqli_num_rows($result) == 0) { 
			//le livre recherché n'existe pas 
		echo "Pas d'objet trouvé"; } 
		else { 
			while ($data = mysqli_fetch_assoc($result)) {
				echo "Id: " . $data['IdVente'] . '<br>';
				$IdVendeur = $data['IdVendeur'];
				$sql2 = "SELECT Nom FROM vendeur WHERE IdVendeur=$IdVendeur";
				$result2 = mysqli_query($db_handle, $sql2);
				$data2 = mysqli_fetch_assoc($result2);
				echo "Nom:" . $data2['Nom'] . '<br>';
				echo "Description: " . $data['Description'] . '<br>';
				echo "Categorie: " . $data['Categorie'] . '<br>';
				echo "Prix de depart: " . $data['PrixDepart'] . '<br>';
				echo "Prix achat immediat :" . $data['PrixAchatImmediat'] . '<br>';
				echo "Type de vente: " . $data['TypeVente'] . '<br>';
				echo "Date d'ajout :" . $data['DateAjout'].'<br>';
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