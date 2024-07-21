<?php  require_once 'connexiondb.php'; 

if (!internauteEstProprietaire()) {
    header("Location: connexionfin.php");
    exit();
}

// Partie enregistrement
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pseudo = $_POST["pseudo"];
    $message = $_POST["message"];

    // Vérifier si les champs sont remplis
    if (!empty($pseudo) && !empty($message)) {
        $query = "INSERT INTO forum (pseudo, commentaire, date_enregistrement) VALUES (:pseudo, :commentaire, NOW())";
        $statement = $condb->prepare($query);
        $statement->bindParam(":pseudo", $pseudo);
        $statement->bindParam(":commentaire", $message);
        $result = $statement->execute();

        if ($result) {
            $contenu .= '<div class="validation">Votre message a bien été enregistré.</div>';
        } else {
            $contenu .= '<div class="erreur">Une erreur est survenue lors de l\'enregistrement du commentaire.</div>';
        }
    } else {
        $contenu .= '<div class="erreur">Veuillez remplir tous les champs du formulaire.</div>';
    }
}

// Partie affichage des commentaires
$query = "SELECT pseudo, commentaire, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS datefr, DATE_FORMAT(date_enregistrement, '%H:%i:%s') AS heurefr FROM forum ORDER BY date_enregistrement DESC";
$resultats = $condb->query($query);
$contenu .= '<h2>' . $resultats->rowCount() . ' commentaire(s)</h2>';

while ($commentaire = $resultats->fetch(PDO::FETCH_ASSOC)) {
    $contenu .= '<div class="message">';
    $contenu .= '<img src="images_logo_icons/avatarcommentaire.png" alt="Avatar" class="avatar">';
    $contenu .= '<div class="pseudo">' . htmlspecialchars($commentaire['pseudo']) . '</div>';
    $contenu .= '<div class="date">' . $commentaire['datefr'] . ' à ' . $commentaire['heurefr'] . '</div>';
    $contenu .= '<div class="contenu">' . htmlspecialchars($commentaire['commentaire']) . '</div>';
    $contenu .= '</div>';
}
?>
<?php require_once 'navbarinclu.php'; ?>
<br><br><br><br><br>
    
    <form method="post" action="" class="formulaire">
        <label for="pseudo" class="forumlabel">Pseudo</label><br>
        <input class="forumtext" type="text" id="pseudo" name="pseudo" maxlength="20" pattern="[a-zA-Z0-9.-_]+" title="caractères autorisés : a-zA-Z0-9.-_"><br>
        <label for="message" class="forumlabel">Message</label><br>
        <textarea class="forumtextarea" id="message" name="message" cols="50" rows="7"></textarea><br>
        <input type="submit" value="Envoyer" class="forumenvoyer">
    </form>
    <div class="commentaire">
        <?php echo $contenu; ?>
    </div><br><br><br><br><br>
    <?php include('footerinclu.php'); ?>