<?php require_once 'connexiondb.php'; // Inclure le fichier de configuration de la base de données
if (!internauteEstAdmin()) {
  header("Location: connexionfin.php");
  exit();
}
require_once 'navbarinclu.php';

echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

// Vérifier si l'identifiant du membre à supprimer a été envoyé via l'URL
if (!empty($_GET['id_proprietaire'])) {
    $id_membre = $_GET['id_proprietaire'];

    // Supprimer le membre de la base de données
    $query = "DELETE FROM inscriproprietaire WHERE id_proprietaire = :id_membre";
    $statement = $condb->prepare($query);
    $statement->bindParam(':id_membre', $id_membre);
    $result = $statement->execute();

   echo '<div class="container">';
    
    if ($result) {
        echo '<div class="alert alert-success">Le membre a été supprimé avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger">Une erreur est survenue lors de la suppression du membre.</div>';
    }
  }

  // Récupérer tous les membres
  $query = "SELECT * FROM inscriproprietaire";
  $statement = $condb->query($query);
  $membres = $statement->fetchAll(PDO::FETCH_ASSOC);
  
    ?>

    <h1 class="banirh1">Gestion des proprietaires</h1><br><br>

    <h2 class="banirh2">Liste des Proprietaires</h2>
    <table class="table banirtable">
        <thead class="thead-dark">
            <tr class="banirtr">
                <th class="banirth">Identifiant</th>
                <th class="banirth">Pseudo</th>
                <th class="banirth">Nom</th>
                <th class="banirth">Prénom(s)</th>
                <th class="banirth">Email</th>
                <th class="banirth">Téléphone</th>
                <th class="banirth">Mot de passe</th>
                <th class="banirth">Statut</th>
                <th class="banirth">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($membres as $membre) : ?>
                <tr class="banirtr">
                    <td class="banirtd"><?php echo $membre['id_proprietaire']; ?></td>
                    <td class="banirtd"><?php echo $membre['pseudo']; ?></td>
                    <td class="banirtd"><?php echo $membre['nom']; ?></td>
                    <td class="banirtd"><?php echo $membre['prenom']; ?></td>
                    <td class="banirtd"><?php echo $membre['email']; ?></td>
                    <td class="banirtd"><?php echo $membre['telephone']; ?></td>
                    <td class="banirtd"><?php echo $membre['mot_de_passe']; ?></td>
                    <td class="banirtd"><?php echo $membre['statut']; ?></td>
                    <td class="banirtd">
                        <a href="banir1membre.php?id_proprietaire=<?php echo $membre['id_proprietaire']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php require_once 'footerinclu.php'; ?>