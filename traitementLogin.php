<?php
session_start();

$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
$type = isset($_POST["type"])? $_POST["type"] : "";

//identifier votre BDD
$database = "ebayece";

//connectez-vous dans votre BDD
$db_handle = mysqli_connect('localhost','root','');
$db_found = mysqli_select_db($db_handle, $database);

if($type=="Client")
{
if ($db_found) {
  $sqlmdp = "SELECT * FROM client WHERE Pseudo ='$pseudo';";
  $resultmdp = mysqli_query($db_handle, $sqlmdp);

  if (mysqli_num_rows($resultmdp) == 0) {
    header('Location:connexion.php?error=1');
    exit();
  }
  else {
    $data=mysqli_fetch_assoc($resultmdp);

    if($mdp == $data['MotDePasse'])  {

    $_SESSION['Type'] = $type;
    $_SESSION['Id'] =(int)$data['IdClient'];
    header('Location:tout.php');
    exit();
    }
    else {
        header('Location:connexion.php?error=1');
        exit();
    }
  }

}else {
  echo "Database not found";
}
}

if($type=="Vendeur")
{
if ($db_found) {
  $sqlmdp = "SELECT * FROM vendeur WHERE Pseudo ='$pseudo';";
  $resultmdp = mysqli_query($db_handle, $sqlmdp);

  if (mysqli_num_rows($resultmdp) == 0) {
    header('Location:connexion.php?error=1');
    exit();
  }
  else {
    $data=mysqli_fetch_assoc($resultmdp);

    if($mdp == $data['MotDePasse'])  {

    $_SESSION['Type'] = $type;
    $_SESSION['Id'] = (int)$data['IdVendeur'];
    header('Location:tout.php');
    exit();
    }
    else {
        header('Location:connexion.php?error=1');
        exit();
    }
  }

}else {
  echo "Database not found";
}
}

if($type=="Admin")
{
if ($db_found) {
  $sqlmdp = "SELECT * FROM admin WHERE Pseudo ='$pseudo';";
  $resultmdp = mysqli_query($db_handle, $sqlmdp);

  if (mysqli_num_rows($resultmdp) == 0) {
    header('Location:connexion.php?error=1');
    exit();
  }
  else {
    $data=mysqli_fetch_assoc($resultmdp);

    if($mdp == $data['MotDePasse'])  {

    $_SESSION['Type'] = $type;
    $_SESSION['Id'] = (int)$data['IdAdmin'];
    header('Location:tout.php');
    exit();
    }
    else {
        header('Location:connexion.php?error=1');
        exit();
    }
  }

}else {
  echo "Database not found";
}
}
//fermer la connexion
mysqli_close($db_handle);


?>
