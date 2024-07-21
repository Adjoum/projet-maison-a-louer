<?php include 'connexiondb.php';
include 'navbarinclu.php';
 echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
if (isset($_GET['id_maison'])) {
    $resultat = '';
    $id_maison = $_GET['id_maison'];

    

        // Préparer la requête avec un paramètre lié
        $query = "SELECT * FROM publicationmaison WHERE id_maison = :id_maison";
        $statement = $condb->prepare($query);
        $statement->bindParam(":id_maison", $id_maison);
        $statement->execute();

        // Récupérer le résultat
        $maison = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$maison) {
            echo "Aucune maison trouvée avec cet ID.";
            exit;
        }
    
}




?>


<main>
  <div class="album py-5 bg-body-tertiary lemien1">
    <div class=" lemien1 container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 container lemien">

        <div class="col ">
          <div class="card shadow-sm">
            <h1 class="text-center"><?= $maison['titre']?></h1>
          <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner container">
            <div class="carousel-item active container">
                <img src="<?= $maison['photo1']?>" class="d-block w-100 img-resize carousel-image" alt="photo 1">
            </div>
            <div class="carousel-item">
                <img src="<?= $maison['photo2']?>" class="d-block w-100 img-resize carousel-image" alt="photo 2">
            </div>
            <div class="carousel-item">
                <img src="<?= $maison['photo3'] ?>" class="d-block w-100 img-resize carousel-image" alt="photo 3">
            </div>
            <div class="carousel-item">
                <img src="<?= $maison['photo4'] ?>" class="d-block w-100 img-resize carousel-image" alt="photo 4">
            </div>
            <div class="carousel-item">
                <img src="<?= $maison['photo5'] ?>" class="d-block w-100 img-resize carousel-image" alt="photo 5">
            </div>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>

            <div class="card-body">
              <p class="card-text"><span>DESCRIPTION : </span><?= $maison['description'] ?> </p><br>
              <p class="card-text"><SPan>REGION : </SPan><?= $maison['region'] ?> </p>
              <p class="card-text"><SPan>VILLE : </SPan><?= $maison['ville'] ?> </p>
              <p class="card-text"><SPan>TEL : </SPan><?= $maison['telephone'] ?> </p>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <p class="btn btn-sm btn-outline-secondary" style="font-size: 185%;"><span>PRIX : </span> <?= $maison['prix'] ?>  FCFA</p>
                  
                </div>
              
              </div>
              <small class="text-body-secondary">Publiée le : <?= $maison['date_enregistrement'] ?> </small>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</main>

<br><br><br><br><br><br>