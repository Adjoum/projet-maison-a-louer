<!doctype html>
<html lang="fr" data-bs-theme="auto">
  <head><script src="/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.115.4">
    <title>Maison en location</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">

    <link rel="icon" type="image/png" href="images_logo_icons/icone2.png">
    <!-- Dans la section <head> de votre page HTML -->

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbars-offcanvas/">

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/styles.css">
    <style>
          h1, h2, h3, h4, h5, h6 {
        font-weight: 600; /* Augmentez ou diminuez selon vos préférences */
    }
    
    p {
        font-size: 25px; /* Taille de police par défaut pour les paragraphes */
    }
    .social-media a{
      font-size: 35px;
    }
    .contact h1 ol li{
  color: white;
  font-size: 25px;
}
    </style>
  </head>
    
<body>
<main class="accueilmain">


  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
      <a class="navbar-brand py-3 logo" href="#">
                <img src="images_logo_icons/logositepro8.png" alt="Logo de la plateforme">
        </a>
      <button class="navbar-toggler humberger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon humb"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Maison à Louer</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 ">

 <?php 
      if(internauteEstAdmin()){

        echo '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mes gestions
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="annonce.php">Gestion des annonces</a></li>
                  <li><a class="dropdown-item" href="banir1membre.php">Gestion des membres</a></li>
                  <li><a class="dropdown-item" href="pagecontact.php">Gestion des publicités</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Règles d\'usage du site</a></li>
                </ul>
              </li>';
      }



      if(internauteEstProprietaire()){

        echo '<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="filtre.php">Recherche filtrée</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="pagesearchhouse.php">Rechercher une maison</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="connexionfin.php">Publier une maison</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="forum.php">Forum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="page_apropos.php">A-propos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="pagecontact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="decon.php">Déconnexion</a>
              </li>';
      }

      else {
      echo '<li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="filtre.php">Recherche filtrée</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="pagesearchhouse.php">Rechercher une maison</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="connexionfin.php">Publier une maison</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="forum.php">Forum</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="page_apropos.php">A-propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="pagecontact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="connexionfin.php">Connexion</a>
            </li>';
          }
 ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  </main>
 