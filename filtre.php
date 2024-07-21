<?php include 'connexiondb.php';  ?>
<?php include 'navbarinclu.php'; ?>
<br><br><br><br>
<div id="contenu">
    
<script>
        // Fonction pour afficher les villes correspondant à la région sélectionnée
        function afficherVilles() {
            var region = document.getElementById('region').value;
            var villeSelect = document.getElementById('ville');

            // Réinitialiser la liste des villes
            villeSelect.innerHTML = '';

            // Sélectionner les villes correspondant à la région choisie
            var villes = [];
            switch (region) {
                case 'Abidjan':
                    villes = ['Abobo', 'Adjamé', 'Annyama', 'Attecoube', 'Bingerville', 'Cocody', 'Koumassi', 'Marcory', 'Plateau', 'Port-Bouet', 'Treichville', 'Songon', 'Yopougon'];
                    break;
                case 'District autonome de Yamoussoukro':
                    villes = ['Yamoussoukro'];
                    break;
                case 'Indénié-Djuablin':
                    villes = ['Abengourou', 'Agnibilékro'];
                    break;
                case 'Sud-Comoé':
                    villes = ['Aboisso'];
                    break;
                case 'Folon':
                    villes = ['Minignan'];
                    break;
                case 'Kabadougou':
                    villes = ['Odienné'];
                    break;
                case 'Goh':
                    villes = ['Gagnoa'];
                    break;
                case 'Loh-Djiboua':
                    villes = ['Divo'];
                    break;
                case 'Iffou':
                    villes = ['Daoukro'];
                    break;
                case 'Moronou':
                    villes = ['Bongouanou'];
                    break;
                case 'Nzi':
                    villes = ['Dimbokro'];
                    break;
                case 'Agnéby-Tiassa':
                    villes = ['Agboville'];
                    break;
                case 'Grands-Ponts':
                    villes = ['Dabou'];
                    break;
                case 'La Mé':
                    villes = ['Adzopé'];
                    break;
                case 'Cavally':
                    villes = ['Guiglo'];
                    break;
                case 'Guémon':
                    villes = ['Duékoué'];
                    break;
                case 'Tonkpi':
                    villes = ['Man'];
                    break;
                case 'Haut-Sassandra':
                    villes = ['Daloa'];
                    break;
                case 'Marahoué':
                    villes = ['Bouaflé'];
                    break;
                case 'Bagoué':
                    villes = ['Boundiali'];
                    break;
                case 'Poro':
                    villes = ['Korhogo'];
                    break;
                case 'Tchologo':
                    villes = ['Ferkessédougou', 'Ouangolodougou'];
                    break;
                case 'Gbekè':
                    villes = ['Bouaké'];
                    break;
                case 'Hambol':
                    villes = ['Katiola'];
                    break;
                case 'Béré':
                    villes = ['Mankono'];
                    break;
                case 'Bafing':
                    villes = ['Touba'];
                    break;
                case 'Worodougou':
                    villes = ['Séguéla'];
                    break;
                case 'Bounkani':
                    villes = ['Bouna', 'Nassian', 'Doropo'];
                    break;
                case 'Gontougo':
                    villes = ['Bondoukou', 'Tanda', 'Koun-Fao', 'Sandegué', 'Assuéfry', 'Transua', 'Tiedjo', 'Yanvo', 'Tangamourou', 'Motiamo'];
                    break;
                case 'Gboklé':
                    villes = ['Sassandra'];
                    break;
                case 'Nawa':
                    villes = ['Soubré'];
                    break;
                case 'San-Pedro':
                    villes = ['San-Pedro'];
                    break;


                // Ajouter d'autres régions et leurs villes ici
            }

            // Afficher les villes dans la liste déroulante
            for (var i = 0; i < villes.length; i++) {
                var option = document.createElement('option');
                option.value = villes[i];
                option.textContent = villes[i];
                villeSelect.appendChild(option);
            }

            // Afficher la liste des villes
            document.getElementById('ville-select').style.display = 'block';
        }

    </script>
<br><br><br><br><br><br><br><br><br>

    <h2 class="text-center ">Filtre avancé</h2>

    <form method="post" class="container inscri_conteneur">
        <label for="region">Région :</label>
        <select id="region" name="region" onchange="afficherVilles()" required>
            <option value="">Sélectionner une région</option>
            <option value="Abidjan">District autonome d'Abidjan</option>
            <option value="District autonome de Yamoussoukro">District autonome de Yamoussoukro</option>
            <option value="Indénié-Djuablin">Indénié-Djuablin</option>
            <option value="Sud-Comoé">Sud-Comoé</option>
            <option value="Folon">Folon</option>
            <option value="Kabadougou">Kabadougou</option>
            <option value="Goh">Goh</option>
            <option value="Loh-Djiboua">Loh-Djiboua</option>
            <option value="Iffou">Iffou</option>
            <option value="Moronou">Moronou</option>
            <option value="Nzi">N'zi</option>
            <option value="Agnéby-Tiassa">Agnéby-Tiassa</option>
            <option value="Grands-Ponts">Grands-Ponts</option>
            <option value="La Mé">La Mé</option>
            <option value="Cavally">Cavally</option>
            <option value="Guémon">Guémon</option>
            <option value="Tonkpi">Tonkpi</option>
            <option value="Haut-Sassandra">Haut-Sassandra</option>
            <option value="Marahoué">Marahoué</option>
            <option value="Bagoué">Bagoué</option>
            <option value="Poro">Poro</option>
            <option value="Tchologo">Tchologo</option>
            <option value="Gbekè">Gbekè</option>
            <option value="Hambol">Hambol</option>
            <option value="Béré">Béré</option>
            <option value="Bafing">Bafing</option>
            <option value="Worodougou">Worodougou</option>
            <option value="Bounkani">Bounkani</option>
            <option value="Gontougo">Gontougo</option>
            <option value="Gboklé">Gboklé</option>
            <option value="Nawa">Nawa</option>
            <option value="San-Pedro">San-Pedro</option>

            
            <!-- Ajouter d'autres régions ici -->
        </select><br><br>

        <div id="ville-select" class="ville-select">
            <label for="ville">Ville :</label><br>
            <select id="ville" name="ville" required>
                <option value="">Sélectionner une ville</option>
                <!-- Les options de villes seront ajoutées dynamiquement via JavaScript -->
            </select>
        </div><br><br>

      <!--  <label for="categorie">Catégorie :</label>
        <select id="categorie" name="categorie">
            <option value="">Sélectionner une catégorie</option>
            <option value="Catégorie 1">Catégorie 1</option>
            <option value="Catégorie 2">Catégorie 2</option>
        </select><br><br>-->

        <input type="submit" value="Filtrer">
    </form>

<?php // Vérifier si le formulaire de filtrage a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les valeurs sélectionnées
    function secureInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        $region = secureInput($_POST["region"]);
        $ville = secureInput($_POST["ville"]);
        //$categorie = secureInput($_POST["categorie"]);

    // Effectuer la requête pour récupérer les maisons correspondantes à la région et à la ville
    $query = "SELECT * FROM publicationmaison WHERE region = :region AND ville = :ville /*AND categorie = :categorie*/";
    $statement = $condb->prepare($query);
    $statement->bindParam(":region", $region);
    $statement->bindParam(":ville", $ville);
    /*$statement->bindParam(":categorie", $categorie);*/
    $statement->execute();
    /*$resultats = $statement->fetchAll(PDO::FETCH_ASSOC);*/
    $maisons = $statement->fetchAll(PDO::FETCH_OBJ);

    /*// Pagination
    $maisonsParPage = 12;
    $totalMaisons = count($resultats);
    $nombreDePages = ceil($totalMaisons / $maisonsParPage);
    $pageCourante = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
    $indexDepart = ($pageCourante - 1) * $maisonsParPage;
    $maisons = array_slice($resultats, $indexDepart, $maisonsParPage);
*/



$annoncesParPage = 12;

// Calculer le nombre total de pages en fonction du nombre total d'annonces et du nombre d'annonces par page
$nombreTotalAnnonces = count($maisons);
$nombreTotalPages = ceil($nombreTotalAnnonces / $annoncesParPage);

// Récupérer le numéro de page actuel à partir de l'URL
$pageActuelle = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculer l'indice de début pour afficher les annonces de la page actuelle
$indiceDebut = ($pageActuelle - 1) * $annoncesParPage;

// Afficher uniquement les annonces pour la page actuelle
$annoncesPageCourante = array_slice($maisons, $indiceDebut, $annoncesParPage);

// Vérifier si des annonces existent
if (count($annoncesPageCourante) > 0) {
    // Vérifier s'il y a des résultats
   /* if (count($maisons) > 0) {
        // Afficher les résultats
     /*   foreach ($maisons as $maison) {
            // Afficher les détails de chaque maison
            echo "<div class='filtremaison'>";
            echo "<img src='" . $maison['photo1'] . "' alt='Maison'>";
            echo "<h3>" . $maison['titre'] . "</h3>";
            echo "<p>" . substr($maison['description'], 0, 10) . "...</p>";
            echo "<p>Prix : " . $maison['prix'] . "</p>";
            echo "<p>Région : " . $maison['region'] . "</p>";
            echo "<p>Ville : " . $maison['ville'] . "</p>";
            echo "<p>Téléphone : " . $maison['telephone'] . "</p>";
            echo "</div>";
        }*/   echo '<div class="separateur" style="height: 1.5vh;" ></div>';
            /* foreach ($maisons as $maison) {
            
             echo   ' <main> <div class="album py-5 bg-body-tertiary">
                <div class="container">
                  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        
        <div class="col">
              <div class="card shadow-sm">
                <p class="text-center"><strong>'. $maison['titre'] . '</strong></p><img src="' . $maison['photo1'] . '" class="carousel-image" alt="photo1"><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text>
                <div class="card-body">
                  <p class="card-text"><strong>Description :</strong>' . substr($maison['description'], 0, 30) . '...</p>
                  <p class="card-text"><strong>Région :</strong>' .  $maison['region'] . '</p>
                  <p class="card-text"><strong>Ville :</strong>' . $maison['ville'] . '</p>
                  <p class="card-text"><strong>Téléphone :</strong>' . $maison['telephone'] . '</p>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Prix par mois :' . $maison['prix'] . 'FCFA</button><a href="fiche_detail.php?id_maison=' . $maison['id_maison'] . '" class="btn btn-sm btn-outline-secondary">Detail</a>
                  <div class="d-flex justify-content-between align-items-center">
                 
                    <small class="text-body-secondary">Publiée le :' . $maison['date_enregistrement'] . '</small>
                  </div>
                </div>
              </div>
            </div> </main>';
    
        }*/



   echo '<main><div class="album py-5 bg-body-tertiary">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';

        foreach ($annoncesPageCourante as $maison) :
            ?>
    
        
            <div class="col">
              <div class="card shadow-sm">
                <p class="text-center"><strong><?= $maison->titre ?></strong></p><img src="<?= $maison->photo1 ?>" class="carousel-image" alt="photo1"><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text>
                <div class="card-body">
                  <p class="card-text"><strong>Description :</strong> <?= substr($maison->description, 0, 30) ?>...</p>
                  <p class="card-text"><strong>Région :</strong> <?= $maison->region ?></p>
                  <p class="card-text"><strong>Ville :</strong> <?= $maison->ville ?></p>
                  <p class="card-text"><strong>Téléphone :</strong> <?= $maison->telephone ?></p>
                  <button type="button" class="btn btn-sm btn-outline-secondary" style="font-size: 200%;">Prix : <strong> <?= $maison->prix ?> FCFA</strong></button><br><a href="fiche_detail.php?id_maison=<?= $maison->id_maison ?> " class="btn btn-sm btn-outline-secondary" style="margin: 3% 0 3% 60%; font-size: 200%;"><strong > Detail</strong></a>
                  <div class="d-flex justify-content-between align-items-center">
                  <!--<div class="btn-group">
                      <a href="fiche_detail.php?id_maison=<?//= $maison->id_maison ?> " class="btn btn-sm btn-outline-secondary">Detail</a>
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
        // Afficher la pagination
    /*    echo "<div class='filtrepagination'>";
        for ($i = 1; $i <= $nombreDePages; $i++) {
            if ($i === $pageCourante) {
                echo "<span class='active'>$i</span>";
            } else {
                echo "<a href='?page=$i'>$i</a>";
            }
        }
        echo "</div>";
    } else {
        // Aucune annonce trouvée pour la région et la ville sélectionnées
        echo '<br><br><br><p style="color: red;" class= "text-center">Aucune annonce trouvée pour la région et la ville sélectionnées.</p>';
    }*/

    echo '<div class="pagination">';
    for ($page = 1; $page <= $nombreTotalPages; $page++) {
        echo '<a href="?page=' . $page . '">' . $page . '</a>';
    }
    echo '</div>';
} else {
    echo '<p class="pagination text-center container" style="color: white; background-color: red; ma">Aucune annonce trouvée pour la région et la ville sélectionnées.</p>';
}

}

?>
</div>
<div class="separateur" style="height: 101vh;" ></div>
<?php include 'footerinclu.php'; ?>