<?php include 'connexiondb.php';
include 'navbarinclu.php';
$erreur = '';
if (!empty($_POST)) {
    // Validation des données saisies
    $expediteur = filter_input(INPUT_POST, 'expediteur', FILTER_VALIDATE_EMAIL);
    $sujet = filter_input(INPUT_POST, 'sujet', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Vérification que les données sont valides
    if (!$expediteur || !$sujet || !$message) {
        $erreur = 'Veuillez remplir correctement tous les champs du formulaire.';
    } else {
        // entête email
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
        $headers .= 'Reply-To: ' . $expediteur . "\r\n";
        $headers .= 'From: "' . ucfirst(substr($expediteur, 0, strpos($expediteur, '@'))) . '"<' . $expediteur . '>' . "\r\n";
        $headers .= 'Delivered-to: adjoumanideyanvo1@gmail.com' . "\r\n";

        // Envoi de l'email
        if (mail("adjoumanideyanvo1@gmail.com", $sujet, $message, $headers)) {
            $erreur = 'Email envoyé avec succès.';
        } else {
            $erreur = 'Une erreur est survenue lors de l\'envoi de l\'email.';
        }
    }
}
?>


    
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<div class="container text-center">
    <h1>
        N'hésitez pas à nous contacter lorsque :
    </h1><br><br>
    <ol>
        <li><p>Le site ne fonctionne pas bien.</p></li>
        <li><p>Vous voulez me dire à quel point le site est génial.</p></li>
        <li><p>Vous avez une idée nouvelle pour une fonctionnalité du site ou du design.</p></li>
        <li><p>Vous etes insatisfait ou satisfait du service.</p></li>
        <li><p>Vous avez une question liée au fonctionnement du site.</p></li>
        <li><p>Vous souhaitez etre partenaire.</p></li>
        <li><p>Vous souhaitez me partager votre tutoriel pour ameliorer le site (le web designe).</p></li>
        <li><p>Vous avez trouvé des failles nuisible du site.</p></li>
        <li><p>vous avez un projet de creation de site web.</p></li>
        <li><p>vous voulez juste me dire 'SALUT'.</p></li>
    </ol>
</div>
<div >
    

<br><br><br><br><br><br><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="contact-form">
                    <h2 class="mb-4">Contactez-moi</h2>
                    <?php if (!empty($erreur)) : ?>
        <div class="alert alert-danger text-center"><?php echo $erreur; ?></div>
    <?php endif; ?>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="expediteur" class="form-label">Expediteur</label>
                            <input type="text" name="expediteur" id="expediteur" class="form-control" placeholder="inscrivez votre e-mail ici">
                        </div>
                        <div class="mb-3">
                            <label for="sujet" class="form-label">Sujet</label>
                            <input type="text" name="sujet" id="sujet" class="form-control" placeholder="sujet">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control" placeholder="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer l'email</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 <?php include 'footerinclu.php'; ?>