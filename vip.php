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
  <nav class="navbar navbar-expand-lg navbar-light align-items-end"  style="font-size:150%;font-weight:bold">
    <a class="navbar-brand" href="index.html"> <img src="logo5.png"  alt=""></a>
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
        <a class="nav-link" style="color:black" href="#">Achat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Vendre mon produit</a>
      </li>

      <li class="nav-item">
        <a class="nav-link"style="color:black" href="#">Mon compte</a>
      </li>
      <li class="nav-item">
        <a class="navbar-brand" href="#">
          <img src="panier.png" width="50" height="50" class="d-inline-block align-top" alt="">

        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:black" href="#">Admin</a>
      </li>


    </ul>
  </nav>

  <section class="jumbotron text-center" style=" background-image: url(vip.jpg)" >
    <div class="container">
      <h1 class="jumbotron-heading align-items-top" style="font-size:500%;font-weight:bold;color:white">ACCESSOIRES VIP</h1>
      <p
    </div>
  </section>

  <div class="container py-5">

    <div class="row">
      <div class="col-lg-8 mx-auto">
        <!-- List group-->
        <ul class="list-group shadow">
          <!-- list group item-->
          <?php

          //identifier votre BDD

          $database = "ebayece";
          //connectez-vous dans votre BDD

          $db_handle = mysqli_connect('localhost', 'root','');
          $db_found = mysqli_select_db($db_handle, $database);

          if ($db_found) {
            $sql = "SELECT * FROM vente WHERE Categorie = 'Accessoire VIP';";
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

          </ul> <!-- End -->
        </div>
      </div>
    </div>

  </body>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </html>
