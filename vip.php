<?php session_start();
if($_SESSION['Type']=="" || $_SESSION['Id']=="")
{
  header('Location: index.php');
  exit;
}
?>
<!doctype html>
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
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          Catégories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="feraille.php">Ferrailles & Trésors</a>
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
        <a class="nav-link" style="color:black" href="traitementLogout.php">
           <img src="logout.png" width="30" height="30" class="d-inline-block align-top" alt="">
        </a>
      </li>


    </ul>
  </nav>

  <section class="jumbotron text-center" style=" background-image: url(vip.jpg)" >
    <div class="container">
      <h1 class="jumbotron-heading align-items-top" style="font-size:500%;font-weight:bold;color:white">ACCESSOIRES VIP</h1>

    </div>
  </section>

  <div class="container py-5">

    <div class="row">
      <div class="col-lg-8 mx-auto">
        <!-- List group-->
        <ul class="list-group shadow">
          <!-- list group item-->
          <?php

          include 'traitementCategories.php';
            affichageCategorie("Accessoire VIP");
            ?>

          </ul> <!-- End -->
        </div>
      </div>
    </div>

  </body>
  <footer class="site-footer mt-auto" style="height:150px;bottom:0;width:100%">
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