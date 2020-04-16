<?php
  session_start();

  $pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
  $mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
  $type = isset($_POST["type"])? $_POST["type"] : "";

    if($type=="Client")
    {

    //identifier votre BDD
  	$database = "ebayece";

  	//connectez-vous dans votre BDD
  	$db_handle = mysqli_connect('localhost', 'root','');
  	$db_found = mysqli_select_db($db_handle, $database);

    if($db_found) echo "YES";

  	if ($db_found) {
      $sqlmdp = "SELECT MotDePasse FROM client WHERE Pseudo = $pseudo;";
      $resultmdp = mysqli_query($db_handle, $sqlmdp);

      if (mysqli_num_rows($resultmdp) == 0) {
        echo "Mot de passe et idenfiant incorrects veuillez réessayer";
      }
      else {
        $data=mysqli_fetch_assoc($resultmdp);
        $_SESSION['Type'] = $type;
        $_SESSION['Id'] = $data['IdClient'];
        echo "Type :".$_SESSION['Type'];
        echo "ID :".$_SESSION['Id'];
      }

  	}else {
  		echo "Database not found";
  	}
  	//fermer la connexion
  	mysqli_close($db_handle);
  }


 ?>
