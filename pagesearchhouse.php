<?php include 'connexiondb.php';
    
    $req = $condb->prepare("SELECT * FROM publicationmaison ORDER BY id_maison DESC");
    $req->execute();
    $maisons = $req->fetchAll(PDO::FETCH_OBJ);

?>

<?php include 'navbarinclu.php';?>

<main>
  <br><br><br><br><br><br>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Trouvez votre logement facilement ici.</h1>
        <p class="lead text-body-secondary"><q cite="https://citation-celebre.leparisien.fr">Personne n'est proprietaire du bonheur, on a de la chance d'avoir un bail, et d'être locataire. Il faut être très regulier sur le paiement de ses loyers, on se fait exproprier très vite.</q><strong><cite>Marc Levy, Ecrivain Francais</cite></strong></p>
        <p>
          <a href="filtre.php" style="font-size: 120%;" class="btn btn-primary my-2">Recherche filtrée</a>
          <a href="tableau_de_bord.php" style="font-size: 120%;" class="btn btn-secondary my-2">Publier une annonce</a>
        </p>
        <p class="lead text-body-secondary">Plus besoin de passer par les agences immobilières pour avoir sa maison à Louer. En un clic vous rentrez en contact direct avec les proprietaires.</p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      <?php
      
      // Définir le nombre d'annonces à afficher par page
        $annoncesParPage = 12;

        // Calculer le nombre total de pages en fonction du nombre total d'annonces et du nombre d'annonces par page
        $nombreTotalAnnonces = count($maisons);
        $nombreTotalPages = ceil($nombreTotalAnnonces / $annoncesParPage);

        // Récupérer le numéro de page actuel à partir de l'URL
        $pageActuelle = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculer l'indice de début pour afficher les annonces de la page actuelle
        $indiceDebut = ($pageActuelle - 1) * $annoncesParPage;

        // Afficher uniquement les annonces pour la page actuelle
        $annoncesPageCourante = array_slice($maisons, $indiceDebut, $annoncesParPage);

        // Vérifier si des annonces existent
        if (count($annoncesPageCourante) > 0) {
            // Boucle d'affichage des annonces
            foreach ($annoncesPageCourante as $maison) :
        ?>

    
        <div class="col">
          <div class="card shadow-sm" data-tilt data-tilt-scale="1.1">
            <p class="text-center"><strong><?= $maison->titre ?></strong></p><img src="<?= $maison->photo1 ?>" class="carousel-image" alt="photo1"><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text>
            <div class="card-body">
              <p class="card-text"><strong>Description :</strong> <?= substr($maison->description, 0, 30) ?>...</p>
              <p class="card-text"><strong>Région :</strong> <?= $maison->region ?></p>
              <p class="card-text"><strong>Ville :</strong> <?= $maison->ville ?></p>
              <p class="card-text"><strong>Téléphone :</strong> <?= $maison->telephone ?></p>
              <button type="button" class="btn btn-sm btn-outline-secondary" style="font-size: 200%;">Prix : <?= $maison->prix ?> FCFA</button><a href="fiche_detail.php?id_maison=<?= $maison->id_maison ?> " class="btn btn-sm btn-outline-secondary" style="margin: 3% 0% 3% 60%; font-size: 200%;">Detail</a>
              <div class="d-flex justify-content-between align-items-center">
              <!--<div class="btn-group">
                  <a href="fiche_detail.php?id_maison=<?//= $maison->id_maison ?> " class="btn btn-sm btn-outline-secondary detail">Detail</a>
                </div> -->
                <small class="text-body-secondary">Publiée le : <?= $maison->date_enregistrement ?></small>
              </div>
            </div>
          </div>
        </div>

        <?php
            endforeach; ?>
        

      </div>
    </div>
  </div>

</main>
<?php
            // Ajouter les liens de pagination
            echo '<div class="pagination">';
            for ($page = 1; $page <= $nombreTotalPages; $page++) {
                echo '<a href="?page=' . $page . '">' . $page . '</a>';
            }
            echo '</div>';
        } else {
            echo '<div class="pagination"><p>Aucune annonce disponible pour le moment.</p></div>';
        }
?>
        <br><br>

<?php include_once 'footerinclu.php'; ?>