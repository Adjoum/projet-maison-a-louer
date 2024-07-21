<?php require_once('connexiondb.php') ;// Inclure le fichier de configuration de la base de données
if (!internauteEstAdmin()) {
    header("Location: connexionfin.php");
    exit();
}
require_once('navbarinclu.php'); 
echo '<br><br><br><br><br><br><br><br><br><br><br><br><br>';
// Fonction pour sécuriser les données saisies
function secureInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Supprimer une publication de maison
if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id_maison'])) {
    $idMaison = intval($_GET['id_maison']);
    $query = "DELETE FROM publicationmaison WHERE id_maison = :idMaison";
    $statement = $condb->prepare($query);
    $statement->bindParam(':idMaison', $idMaison, PDO::PARAM_INT);
    $result = $statement->execute();
    
    echo '<div class="container">';
    if ($result) {
        echo '<div class="alert alert-success">La publication a été supprimée avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger">Une erreur est survenue lors de la suppression de la publication.</div>';
    }
  }

  // Récupérer toutes les publications de maisons
  $query = "SELECT * FROM publicationmaison ORDER BY date_enregistrement DESC";
  $statement = $condb->query($query);
  $publications = $statement->fetchAll(PDO::FETCH_ASSOC);
  
  // Afficher les publications de maisons dans un tableau
  ?>
  

    <h1 class="annonceh1">Back-end du site de recherche de maisons en location</h1>

    <h2 class="annonceh2">Publications de maisons</h2>
    <table class="table annoncetable">
        <thead class="thead-dark">
            <tr class="annoncetr">
                <th class="annonceth">Titre</th>
                <th class="annonceth">Description</th>
                <th class="annonceth">Prix</th>
                <th class="annonceth">Région</th>
                <th class="annonceth">Ville</th>
                <th class="annonceth">Téléphone</th>
                <th class="annonceth">Photos</th>
                <th class="annonceth">Date d'enregistrement</th>
                <th class="annonceth">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($publications as $publication) : ?>
                <tr class="annoncetr">
                    <td class="annoncetd"><?php echo $publication['titre']; ?></td>
                    <td class="annoncetd"><?php echo $publication['description']; ?></td>
                    <td class="annoncetd"><?php echo $publication['prix']; ?></td>
                    <td class="annoncetd"><?php echo $publication['region']; ?></td>
                    <td class="annoncetd"><?php echo $publication['ville']; ?></td>
                    <td class="annoncetd"><?php echo $publication['telephone']; ?></td>
                    <td class="annoncetd">
                        <?php for ($i = 1; $i <= 5; $i++) {
                            $photo = $publication['photo'.$i];
                            if (!empty($photo)) {
                                echo "<img src=\"$photo\" alt=\"Photo $i\">";
                            }
                        } ?>
                    </td>
                    <td class="annoncetd"><?php echo $publication['date_enregistrement']; ?></td>
                    <td class="annoncetd">
                        <a href="?action=supprimer&id_maison=<?php echo $publication['id_maison']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


   <!-- <h2>Demandes de location</h2>
     Insérez ici le code pour afficher les demandes de location, si vous avez une table spécifique pour cela -->