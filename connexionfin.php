<?php include_once('connexiondb.php'); // Inclusion du fichier de configuration de la base de données

if(internauteEstProprietaire()){header("Location: tableau_de_bord.php");}
// Vérification si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données saisies par l'utilisateur
    $pseudo = $_POST["pseudo"];
    $motDePasse = $_POST["mot_de_passe"];

    // Vérification si les champs ne sont pas vides
    if (!empty($pseudo) && !empty($motDePasse)) {
        // Préparation de la requête pour récupérer les données de l'utilisateur
        $requete = $condb->prepare("SELECT * FROM inscriproprietaire WHERE pseudo = :pseudo");
        $requete->bindParam(":pseudo", $pseudo);
        $requete->execute();

        // Vérification si l'utilisateur existe dans la base de données
        if ($requete->rowCount() === 1) {
            $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

            // Vérification du mot de passe saisi avec celui enregistré
            if (password_verify($motDePasse, $utilisateur["mot_de_passe"])) {
                // Authentification réussie, écrire dans la session
                $_SESSION["pseudo"] = $utilisateur["pseudo"];
                $_SESSION["statut"] = $utilisateur["statut"];
                // Redirection vers la page d'accueil ou une autre page protégée
                header("Location: tableau_de_bord.php");
                exit();
            } else {
                $erreur = "Mot de passe incorrect.";
            }
        } else {
            $erreur = "Pseudo incorrect.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}

?>
<?php include('navbarinclu.php'); ?>
<div id= "contenu"> 
    <br><br><br><br><br><br><br><br><br><br>
<?php  echo ' <div class="container inscri_conteneur">';
  
echo '<h1 class="conh1 text-center">Connexion</h1>';

     if (isset($erreur)) {
      echo  '<div class="conerreur text-center">' . $erreur . '</div>';
    }

   echo '<form method="post" action="" class="conform" data-tilt data-tilt-full-page-listening>
        <label for="pseudo" class="conlabel">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" required class="context"><br><br>

        <label for="mot_de_passe">Mot de passe</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required class="conpassword"><br><br>

        <input type="submit" value="Se connecter" class="consubmit">
        <p>Vous n\'avez pas encore de compte ? <a href="inscrip.php">Inscrivez-vous ici</a> pour publier ou pour tchater sur le forum.</p><br>
        
    </form>';
    echo '</div>';
    ?>
</div>
<div class="separateur" style="height: 100vh;" ></div>
<?php include('footerinclu.php'); ?>