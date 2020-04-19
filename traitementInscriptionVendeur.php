<?php


<<<<<<< HEAD
function inscrireVendeur($nom,$prenom,$tel,$email,$pays,$identifiant,$mdp){
	if(isset($_FILES["image"])){ 
=======
function inscrireVendeur($nom,$tel,$prenom,$email,$pays,$identifiant,$mdp){
	if(isset($_FILES["image"])){
>>>>>>> niko
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

<<<<<<< HEAD
	$sqlVendeur = "INSERT INTO `vendeur` (`IdVendeur`, `E-mail`, `Pseudo`, `MotDePasse`, `Photo`, `ImageFond`, `Nom`, Prenom, `Pays`, `Telephone`, `PorteMonnaie`) VALUES (NULL, '$email', '$identifiant', '$mdp', '$photo', '$photo', '$nom', $prenom, '$pays', '$tel', '0')";
=======
	$sqlVendeur = "INSERT INTO vendeur ('IdVendeur',`E-mail`, `Pseudo`, `MotDePasse`, `Photo`, `ImageFond`, `Nom`,'Prenom', `Pays`, `Telephone`, `PorteMonnaie`)
	 VALUES  (NULL,'$email', '$identifiant', '$mdp', '$photo', '$photo', '$nom','$prenom','$pays', '$tel', 0)";
>>>>>>> niko
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

<<<<<<< HEAD
if($nom=="" || $prenom =="" || $tel=="" || $email=="" || $pays=="" || $identifiant=="" || $mdp==""){
	header('Location: viewInscriptionVendeur.php?error=1');
=======
if($nom=="" || $prenom=="" ||  $tel=="" || $email=="" || $pays=="" || $identifiant=="" || $mdp==""){
	header('Location: viewAdmin.php?error=1');
>>>>>>> niko
	exit;

}
else{
<<<<<<< HEAD
	inscrireVendeur($nom,$prenom, $tel,$email,$pays,$identifiant,$mdp);
=======
	inscrireVendeur($nom,$tel,$prenom,$email,$pays,$identifiant,$mdp);
>>>>>>> niko
	header('Location: viewAdmin.php?result=1');
	exit;
}
?>
