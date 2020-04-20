<?php session_start();?>
<!doctype HTML>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="styles.css" rel="stylesheet" type="text/css">
  <title>Ebay Ece</title>
</head>
<body >
  <nav class="navbar navbar-expand-lg navbar-light align-items-end"  style="font-size:130%;font-weight:bold">
    <a class="navbar-brand" href="viewAccueil.php"> <img src="logo5.png"  alt=""></a>
    <ul class="navbar-nav mr-auto">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          Catégories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="feraille.php">Ferrailles ou Trésors</a>
          <a class="dropdown-item" href="musee.php">Bon pour musée</a>
          <a class="dropdown-item" href="vip.php">Accesoires VIP</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="tout.php">Voir tous les articles</a>
        </div>
      </li>

    </ul>

    <ul class="navbar-nav ml-auto align-items-end" >
      <li class="nav-item">
        <a class="nav-link" style="color:black" href="viewachats.php">Achats & Négociations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewventes.php">Vendre mon produit</a>
      </li>

      <li class="nav-item">
        <a class="nav-link"style="color:black" href="viewcompte.php">Mon compte</a>
      </li>
      <li class="nav-item">
        <a class="navbar-brand" href="viewpanier.php">
          <img src="panier.png" width="40" height="40" class="d-inline-block align-top" alt="">

        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:black" href="viewAdmin.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:black" href="index.php">
           <img src="logout.png" width="30" height="30" class="d-inline-block align-top" alt="">
        </a>
      </li>


    </ul>
  </nav>

  <section class="jumbotron text-center" style="background-image:url(bibli.png);" >
    <div class="container">
      <h1 class="jumbotron-heading align-items-top" style="font-size:500%;font-weight:bold;color:white">MON PRODUIT</h1>

    </div>
  </section>


  <?php
  include 'traitementProduit.php';
  affichageProduit($_GET['id'],$_SESSION['Type']);
  $enchere = isset($_GET["enchere"])? $_GET["enchere"] : "";
  $nego = isset($_GET["nego"])? $_GET["nego"] : "";
  $autoenchere = isset($_GET["autoenchere"])? $_GET["autoenchere"] : "";
  $result = isset($_GET["result"])? $_GET["result"] : "";

  if($result==3){
    echo <<< FOOBAR
    <script language="javascript"> alert("Le produit est déjà dans votre panier"); </script>
    FOOBAR;
  }

  if($result==1){
    echo <<< FOOBAR
    <script language="javascript"> alert("Le produit a été ajouté au panier"); </script>
    FOOBAR;
  }
  if($enchere==3){
    echo <<< FOOBAR
    <script language="javascript"> alert("Vous ne pouvez pas entrer ce prix, l'offre n'a pas été ajoutée"); </script>
    FOOBAR;
  }

  if($enchere==1){
    echo <<< FOOBAR
    <script language="javascript"> alert("Bravo, l'offre a été ajoutée, vous avez acquis l'enchère"); </script>
    FOOBAR;
  }
  if($enchere==2){
    echo <<< FOOBAR
    <script language="javascript"> alert("Votre offre a été prise en compte mais un autre utilisateur a proposé un prix supérieur en auto-enchère"); </script>
    FOOBAR;
  }

  if($nego==1){
    echo <<< FOOBAR
    <script language="javascript"> alert("Bravo, votre première offre a été prise en compte"); </script>
    FOOBAR;
  }
  if($nego==2){
    echo <<< FOOBAR
    <script language="javascript"> alert("Vous ne pouvez pas proposer une offre à ce prix ou vous avez déjà proposé une négociation"); </script>
    FOOBAR;
  }
  if($autoenchere==3){
    echo <<< FOOBAR
    <script language="javascript"> alert("Vous ne pouvez pas entrer ce prix, l'offre n'a pas été ajoutée"); </script>
    FOOBAR;
  }

  if($autoenchere==1){
    echo <<< FOOBAR
    <script language="javascript"> alert("Bravo, l'offre a été ajoutée, vous avez acquis l'enchère"); </script>
    FOOBAR;
  }
  if($autoenchere==2){
    echo <<< FOOBAR
    <script language="javascript"> alert("Votre offre a été prise en compte mais un autre utilisateur a proposé un prix supérieur en auto-enchère"); </script>
    FOOBAR;
  }



  ?>

</body>
<br>
<footer class="site-footer" style="height:150px">
  <hr>
  
  <div class="container mt-2">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <h6><strong>A propos de nous</strong></h6>
        <p class="text-justify">Ecebay est une intiative pour les amateurs de beaux objets. Notre site recense uniquement des articles de qualité. Notre univers varié de produits permettra au plus avide des collectionneurs comme à un client de simple passage de trouver son bonheur .</p>
      </div>

      <div class="col-xs-6 col-md-3">
        <h6><strong>Navigation</strong></h6>
        <ul style="color:black">
          <li><a href="tout.php" style="color:black">Tous les articles</a></li>
          <li><a href="viewachats.php"style="color:black">Achats et Négociations</a></li>
          <li><a href="viewventes.php"style="color:black">Vendre un produit</a></li>
          <li><a href="viewcompte.php"style="color:black">Mon compte</a></li>
          <li><a href="viewpanier.php"style="color:black">Panier</a></li>
        </ul>
      </div>

      <div class=" col-md-3">
        <h6><strong>Nous contacter</strong></h6>
        <ul class="footer-links ">
          <li>Par téléphone au <strong> 01.03.04.89.33 </strong></li>
          <li>Par email: <a href="mailto:contact@ecebay.com"style="color:black"><strong>contact@ecebay.com</strong></a></li>
        
        </ul>
      </div>
    </div>
    
  </div>
  <div class="footer-copyright text-center py-2" style="background-color:#f1f1f1">Copyright &copy; 2020 All Rights Reserved by ECEBAY 
  </div>


</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</html>