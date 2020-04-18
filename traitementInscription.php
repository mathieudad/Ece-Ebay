<?php


function inscrireClient ($nom,$prenom,$tel,$email,$adresse,$ville,$codePostal,$pays,$identifiant,$mdp,$typeCarte,$nomCarte,$numCarte,$dateExpi,$codeSecu,$porteMonnaie){

  $database = "ebayece";

  //connectez-vous dans votre BDD
  $db_handle = mysqli_connect('localhost','root','');
  $db_found = mysqli_select_db($db_handle, $database);

  $sqlClient = "INSERT INTO `client`(`Nom`, `Prenom`, `E-mail`, `Pseudo`, `MotDePasse`, `Adresse`, `CodePostal`, `Ville`, `Pays`, `Telephone`,`Panier`,`TypeCarte`,`NumCarte`,`NomCarte`,`DateExpCarte`,`CodeCarte`,`PorteMonnaie`)
  VALUES  ('$nom', '$prenom', '$email', '$identifiant', '$mdp', '$adresse', '$codePostal', '$ville', '$pays', '$tel',NULL, '$typeCarte','$numCarte','$nomCarte','$dateExpi','$codeSecu','$porteMonnaie')";

  $res = mysqli_query($db_handle, $sqlClient);


  mysqli_close($db_handle);

}


$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$tel = isset($_POST["telephone"])? $_POST["telephone"] : "";
$email= isset($_POST["email"])? $_POST["email"] : "";
$adresse = isset($_POST["adresse"])? $_POST["adresse"] : "";
$ville = isset($_POST["ville"])? $_POST["ville"] : "";
$codePostal = isset($_POST["codepostal"])? $_POST["codepostal"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
$identifiant= isset($_POST["identifiant"])? $_POST["identifiant"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
$typeCarte = isset($_POST["typecarte"])? $_POST["typecarte"] : "";
$nomCarte = isset($_POST["nomcarte"])? $_POST["nomcarte"] : "";
$numCarte = isset($_POST["numcarte"])? $_POST["numcarte"] : "";
$dateExpi = isset($_POST["dateExpi"])? $_POST["dateExpi"] : "";
$codeSecu = isset($_POST["crypto"])? $_POST["crypto"] : "";
$porteMonnaie = isset($_POST["portemonnaie"])? $_POST["portemonnaie"] : "";

if($nom=="" || $prenom=="" || $tel=="" || $email=="" || $adresse=="" || $ville=="" || $codePostal=="" || $pays=="" || $identifiant=="" ||
$mdp=="" || $typeCarte=="" || $nomCarte=="" || $numCarte=="" || $dateExpi==""||$codeSecu==""||$porteMonnaie==""){

  header('Location: viewInscription.php?error=1');
  exit;

}
else{
  inscrireClient ($nom,$prenom,$tel,$email,$adresse,$ville,$codePostal,$pays,$identifiant,$mdp,$typeCarte,$nomCarte,$numCarte,$dateExpi,$codeSecu,$porteMonnaie);
  header('Location: index.php?error=2');
  exit;
}
?>
