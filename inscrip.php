<?php include_once('connexiondb.php');
if(internauteEstProprietaire()){header("Location: tableau_de_bord.php");}
//--------- TRAITEMENT DU FORMULAIRE D'INSCRIPTION
echo '<br><br><br><br><br><br><br><br><br><br><br>';
if (isset($_POST['inscription'])) {
    if (empty($_POST['pseudo']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['telephone']) || empty($_POST['mot_de_passe'])) {
        die('<div class="affich"> Tous les champs doivent être remplis. </div>');
    }

    $pseudo = securiserChamp($_POST['pseudo']);
    $nom = securiserChamp($_POST['nom']);
    $prenom = securiserChamp($_POST['prenom']);
    $email = securiserChamp($_POST['email']);
    $telephone = securiserChamp($_POST['telephone']);
    $motDePasse = hacherMotDePasse($_POST['mot_de_passe']);

    // Vérification des contraintes supplémentaires (non vérifiées côté client pour éviter les attaques par contournement)
    if (strlen($pseudo) < 4 || strlen($pseudo) > 20 || !preg_match('#^[a-zA-Z0-9-_.]+$#', $pseudo)) {
        // Gérer l'erreur du pseudo
        die('<div class="affich">Le pseudo doit contenir entre 4 et 20 caractères. Caractères acceptés : Lettre de A à Z, chiffre de 0 à 9, tiret, point, et souligné.</div>');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Gérer l'erreur de l'email
        die('<div class="affich">L\'adresse email n\'est pas valide.</div>');
    }

    // Vérifier si le pseudo est déjà utilisé
    $requeteVerifPseudo = $condb->prepare("SELECT COUNT(*) FROM inscriproprietaire WHERE pseudo = ?");
    $requeteVerifPseudo->execute(array($pseudo));
    $nbPseudos = $requeteVerifPseudo->fetchColumn();

    if ($nbPseudos > 0) {
        // Gérer l'erreur du pseudo déjà utilisé
        die('<div class="affich">Le pseudo est déjà utilisé. Veuillez en choisir un autre.</div>');
    }

    // Requête préparée pour insérer l'utilisateur dans la base de données
    $requete = $condb->prepare("INSERT INTO inscriproprietaire (pseudo, nom, prenom, email, telephone, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?)");
    $requete->execute(array($pseudo, $nom, $prenom, $email, $telephone, $motDePasse));
    // Rediriger l'utilisateur vers une page de confirmation ou d'accueil
    header("Location: confirmation_inscription.php");
    exit();

}

include_once('navbarinclu.php'); 
?>
 
<!-- inscription.php -->

    <div class="container inscri_conteneur">

        <h2 class="inscrih2">Inscription Propriétaire</h2>

        <form method="post" action="" class="inscriform">

            <label for="pseudo" class="inscrilabel"><strong>Pseudo<sup style="color: red; font-size: 20px;">*</sup></strong><i class="bi bi-info-circle-fill" title="Caractères autorisés : [a-zA-Z0-9-_.]; La longueur doit être comprise entre 4 et 20 caractères." data-placement="left"></i></label><br>
            <input type="text" id="pseudo" class="inscriinput" name="pseudo" maxlength="20" placeholder="Ex : Adjoum1er" pattern="[a-zA-Z0-9-_.]{4,20}" title="caractères acceptés :
            a-zA-Z0-9-_." required="required">
            <small>Caractères autorisés : [a-zA-Z0-9-_.]; La longueur doit être comprise entre 4 et 20 caractères. </small>

            <label for="nom" class="inscrilabel"><strong>Nom<sup style="color: red; font-size: 20px;">*</sup></strong><i class="bi bi-info-circle-fill" title="Caractères autorisés : [a-zA-Z0-9-_.]; La longueur doit être comprise entre 4 et 20 caractères." data-placement="left"></i></label>
            <input type="text" id="nom" class="inscriinput" name="nom" required pattern="[a-zA-ZÀ-ÿ '-]{2,50}" placeholder="Ex : Adjoumani">
            <!-- Contrainte : seuls les lettres, espaces, tirets et apostrophes sont autorisés. La longueur doit être comprise entre 2 et 50 caractères -->
            <small>Caractères autorisés : [a-zA-ZÀ-ÿ '-]; La longueur doit être comprise entre 2 et 50 caractères. </small>

            <label for="prenom" class="inscrilabel"><strong>Prénom(s)<sup style="color: red; font-size: 20px;">*</sup></strong><i class="bi bi-info-circle-fill" title="Caractères autorisés : [a-zA-ZÀ-ÿ '-]; La longueur doit être comprise entre 2 et 50 caractères." data-placement="left"></i></label>
            <input type="text" id="prenom" class="inscriinput" name="prenom" required pattern="[a-zA-ZÀ-ÿ '-]{2,50}" placeholder="Ex : Kouassi Romaric">
            <!-- Contrainte : seuls les lettres, espaces, tirets et apostrophes sont autorisés. La longueur doit être comprise entre 2 et 50 caractères -->
            <small>Caractères autorisés : [a-zA-ZÀ-ÿ '-]; La longueur doit être comprise entre 2 et 50 caractères. </small>

            <label for="email" class="inscrilabel"><strong>E-mail<sup style="color: red; font-size: 20px;">*</sup></strong><i class="bi bi-info-circle-fill" title="Ce champ doit contenir une adresse email valide." data-placement="left"></i></label>
            <input type="email" id="email" class="inscriinput" name="email" required placeholder="Ex : kouassiroma123@gmail.com">
            <!-- Contrainte : le champ doit contenir une adresse email valide -->
            <small>Le champ doit contenir une adresse email valide.</small>

            <label for="telephone" class="inscrilabel"><strong>Téléphone<sup style="color: red; font-size: 20px;">*</sup></strong><i class="bi bi-info-circle-fill" title="Caractères autorisés : [0-9+]. La longueur doit être comprise entre 8 et 20 caractères." data-placement="left"></i></label>
            <input type="tel" id="telephone"class="inscriinput" name="telephone" required pattern="[0-9+]{10,15}" placeholder="Ex : +2250700000000" minlength="10" maxlength="15">
            <!-- Contrainte : seuls les chiffres et le signe "+" sont autorisés. La longueur doit être comprise entre 8 et 20 caractères -->
            <small>Caractères autorisés : [0-9+]. La longueur doit être comprise entre 8 et 20 caractères. </small>

            <label for="mot_de_passe" class="inscrilabel"><strong>Mot de passe<sup style="color: red; font-size: 20px;">*</sup></strong><i class="bi bi-info-circle-fill" title="Caractères autorisés : (?=.*\d)(?=.*[a-z])(?=.*[A-Z]); Au moins 8 caractères." data-placement="left"></i></label>
            <input type="password" id="mot_de_passe" class="inscriinput" name="mot_de_passe" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <!-- Contrainte : le mot de passe doit contenir au moins 8 caractères, dont au moins un chiffre, une lettre minuscule et une lettre majuscule -->
            <small>Caractères autorisés : (?=.*\d)(?=.*[a-z])(?=.*[A-Z]); Au moins 8 caractères. </small><br><br>
            <div class="checkbox">
                    <label style="display: block;  text-align: center">
                        <input type="checkbox" name="cgv" required="" style="margin-top: 2px;"> J'ai lu et j'accepte <a href="useconditions.php" data-toggle="modal" data-target="#modalcgv">les termes et conditions de Recherche Maison à Louer</a>.
                    </label>
                </div>
            <input type="submit" value="S'inscrire" name="inscription" class="inscrisubmit">

        </form>

    </div>
    <div class="separateur col-md-12" style="margin-top: 50%;"></div>>
<?php include('footerinclu.php'); ?>