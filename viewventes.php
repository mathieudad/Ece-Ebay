<?php session_start();?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="styles1.css" rel="stylesheet" type="text/css">
  <title>Ebay Ece</title>
</head>
<body >
  <nav class="navbar navbar-expand-lg navbar-light align-items-end"  style="font-size:150%;font-weight:bold">
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
          <img src="panier.png" width="50" height="50" class="d-inline-block align-top" alt="">

        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:black" href="#">Admin</a>
      </li>


    </ul>
  </nav>

  <section class="jumbotron text-center" style="background-image:url(ventes1.jpg)" >
    <div class="container">
      <h1 class="jumbotron-heading align-items-top" style="font-size:500%;font-weight:bold;color:white">VENTES</h1>

    </div>
  </section>

  <div class="container align-content-center">

    <?php $result = isset($_GET["result"])? $_GET["result"] : "";

    if($result==1){
      echo <<< FOOBAR
      <script language="javascript"> alert("Votre vente a été enregistré"); </script>
      FOOBAR;
    }
    ?>


    <div class="container align-content-center">
      <h3 style="font-weight:bold;color:black"> Ajout d'un produit à vendre </h3>
      <hr>
     <div class="d-flex  h-100">

       <div class="user_card">
         <div class="d-flex ">

         </div>

         <div class="d-flex  form_container">



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
    <h4 style="font-weight:bold;color:black">Vos Ventes en Cours</h4>
    <hr>

    <?php include'traitementVendre.php';
    affichageVendre($_SESSION['Type'],$_SESSION['Id']); ?>

    <hr>



  </div>
  </body>
  <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script id="rendered-js"> </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </html>
