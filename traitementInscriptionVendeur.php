<?php


function inscrireVendeur($nom,$tel,$prenom,$email,$pays,$identifiant,$mdp){
	if(isset($_FILES["image"])){
		$dossier = 'PhotoProfil/';
		$fichier = basename($_FILES['image']['name']);
		$photo = $dossier.$fichier;
		move_uploaded_file($_FILES['image']['tmp_name'], $photo);
	}else{
		header('Location: viewInscriptionVendeur.php?error=3');
		exit;
	}
	$database = "ebayece";

  //connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost','root','');
	$db_found = mysqli_select_db($db_handle, $database);

	$sqlVendeur = "INSERT INTO vendeur ('IdVendeur',`E-mail`, `Pseudo`, `MotDePasse`, `Photo`, `ImageFond`, `Nom`,'Prenom', `Pays`, `Telephone`, `PorteMonnaie`)
	 VALUES  (NULL,'$email', '$identifiant', '$mdp', '$photo', '$photo', '$nom','$prenom','$pays', '$tel', 0)";
	$res = mysqli_query($db_handle, $sqlVendeur);

,
	mysqli_close($db_handle);

}


$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$tel = isset($_POST["telephone"])? $_POST["telephone"] : "";
$email= isset($_POST["email"])? $_POST["email"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
$identifiant= isset($_POST["identifiant"])? $_POST["identifiant"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";

if($nom=="" || $prenom=="" ||  $tel=="" || $email=="" || $pays=="" || $identifiant=="" || $mdp==""){
	header('Location: viewAdmin.php?error=1');
	exit;

}
else{
	inscrireVendeur($nom,$tel,$prenom,$email,$pays,$identifiant,$mdp);
	header('Location: viewAdmin.php?result=1');
	exit;
}
?>
