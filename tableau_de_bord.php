<?php include_once('connexiondb.php'); // Inclusion du fichier de configuration de la base de données
// Vérification si l'utilisateur est connecté, sinon rediriger vers la page de connexion
/*session_start();*/
if (!internauteEstProprietaire()) {
    header("Location: connexionfin.php");
    exit();
}

// Récupérer les informations de l'utilisateur connecté à partir de la base de données
$pseudo = $_SESSION["pseudo"];
$requete = $condb->prepare("SELECT * FROM inscriproprietaire WHERE pseudo = :pseudo");
$requete->bindParam(":pseudo", $pseudo);
$requete->execute();
$utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
?>
<?php include('navbarinclu.php'); ?>
<br><br><br><br><br><br><br><br><br>

    <h1 class="bordh1">Tableau de Bord</h1>

    <div class="bordbienvenue">Bienvenue, <?php echo $utilisateur['pseudo']; ?> !</div>

    <div class="bordinformations" data-tilt data-tilt-axis="x">
        <div class="bordlabel">Votre adresse IP est : <?= $_SERVER['REMOTE_ADDR']; ?></div>
        <div class="bordlabel">Nom :</div>
        <div class="bordvaleur"><?php echo $utilisateur['nom']; ?></div>

        <div class="bordlabel">Prénom :</div>
        <div class="bordvaleur"><?php echo $utilisateur['prenom']; ?></div>

        <div class="bordlabel">Email :</div>
        <div class="bordvaleuremail"><?php echo $utilisateur['email']; ?></div>

        <!-- Ajoutez ici d'autres informations de l'utilisateur si nécessaire -->
    </div>

    <div class="borddeconnexion">
    <form id="form-deconnexion" method="post" action="decon.php">
        <input type="submit" value="Se déconnecter" onclick="return confirmerDeconnexion();">
    </form>
    </div>

    <script>
        function confirmerDeconnexion() {
            if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
                return true; // La déconnexion aura lieu
            } else {
                return false; // La déconnexion est annulée
            }
        }
    </script>
<?php
// Vérification si le formulaire a été soumis
if (!empty($_POST)) {
    // Inclure le fichier de configuration de la base de données
   

    // Fonction pour sécuriser les données saisies
    function secureInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Récupérer les données du formulaire
    $titre = secureInput($_POST['titre']);
    $description = secureInput($_POST['description']);
    $prix = secureInput($_POST['prix']);
    $region = secureInput($_POST['region']);
    $ville = secureInput($_POST['ville']);
    $telephone = secureInput($_POST['telephone']);



  

  $photos = [];

$maxFileSize = 1048576; // 5 Mo

for ($i = 1; $i <= 5; $i++) {
    if (!empty($_FILES['photo']['name'][$i-1])) {
        $extension = pathinfo($_FILES['photo']['name'][$i-1], PATHINFO_EXTENSION);
        $nom_photo = uniqid() . '_' . $_FILES['photo']['name'][$i-1];
        $photo_dossier = 'imagespu/' . $nom_photo;

        if ($extension === 'png' || $extension === 'jpg' || $extension === 'jpeg') {
            if ($_FILES['photo']['size'][$i-1] <= $maxFileSize) {
                move_uploaded_file($_FILES['photo']['tmp_name'][$i-1], $photo_dossier);
                $photos['photo'.$i] = $photo_dossier;
            } else {
                echo '<p class="pagpuberreur">La taille de la photo '.$i.' dépasse la limite autorisée (1 Mo ou 1024 Ko).</p>';
                exit;
            }
        } else {
            echo '<p class="pagpuberreur">Veuillez télécharger uniquement des photos au format PNG ou JPG ou JPEG.</p>';
            exit;
        }
    } else {
        echo '<p class="pagpuberreur">Vous avez choisi moins de 5 photos. Veuillez en choisir exactement 5 photos (Pas plus pas moins !).</p>';
        exit;
    }
}

$query = "INSERT INTO publicationmaison (titre, description, prix, region, ville, telephone, photo1, photo2, photo3, photo4, photo5, date_enregistrement) VALUES (:titre, :description, :prix, :region, :ville, :telephone, :photo1, :photo2, :photo3, :photo4, :photo5, NOW())";

$statement = $condb->prepare($query);

$params = array(
    ':titre' => $titre,
    ':description' => $description,
    ':prix' => $prix,
    ':region' => $region,
    ':ville' => $ville,
    ':telephone' => $telephone,
    ':photo1' => $photos['photo1'],
    ':photo2' => $photos['photo2'],
    ':photo3' => $photos['photo3'],
    ':photo4' => $photos['photo4'],
    ':photo5' => $photos['photo5']
);

$result = $statement->execute($params);

if ($result) {
    echo '<p class="pagpubvalidation">Votre annonce a été publiée avec succès.</p>';
} else {
    echo '<p class="pagpuberreur">Une erreur est survenue lors de la publication de l\'annonce.</p>';
}

   /* // Vérifier si toutes les photos ont été correctement uploadées
    $photos = [];
    for ($i = 1; $i <= 5; $i++) {
            if (!empty($_FILES['photo']['name'][$i-1])) {
                $extension = pathinfo($_FILES['photo']['name'][$i-1], PATHINFO_EXTENSION);
                if ($extension === 'png' || $extension === 'jpg' || $extension === 'jpeg') {
                    $nom_photo = uniqid() . '_' . $_FILES['photo']['name'][$i-1];
                    $photo_dossier = 'imagespu/' . $nom_photo;
                    move_uploaded_file($_FILES['photo']['tmp_name'][$i-1], $photo_dossier);
                    $photos['photo'.$i] = $photo_dossier;
                } else {
                    echo '<p class="pagpuberreur">Veuillez télécharger uniquement des photos au format PNG ou JPG ou JPEG.</p>';
                    exit; // Arrêter le script en cas d'erreur
                }
            } else {
                echo '<p class="pagpuberreur">Vous avez choisi moins de 5 photos. Veuillez en choisir exactement 5 photos (Pas plus pas moins !).</p>';
                exit; // Arrêter le script en cas d'erreur
            }
    }

    // Vérifier le nombre total d'images
    if (count($photos) !== 5) {
        echo '<p class="pagpuberreur">Vous devez sélectionner exactement 5 images.</p>';
        exit; // Arrêter le script en cas d'erreur
    }

    // Vérifier la taille des images
    
    $maxFileSize = 5242880; // Taille maximale des images : 5 Mo
    foreach ($photos as $photoPath) {
        if (filesize($photoPath) > $maxFileSize) {
            echo '<p class="pagpuberreur">La taille d\'une ou plusieurs images est trop volumineuse (maximum 5 Mo).</p>';
            exit; // Arrêter le script en cas d'erreur
        }
    }

    // Préparation de la requête SQL avec des paramètres liés
    $query = "INSERT INTO publicationmaison (titre, description, prix, region, ville, telephone, photo1, photo2, photo3, photo4, photo5, date_enregistrement) VALUES (:titre, :description, :prix, :region, :ville, :telephone, :photo1, :photo2, :photo3, :photo4, :photo5, NOW())";
    $statement = $condb->prepare($query);

    // Exécution de la requête avec les données sécurisées
    $params = array(
        ':titre' => $titre,
        ':description' => $description,
        ':prix' => $prix,
        ':region' => $region,
        ':ville' => $ville,
        ':telephone' => $telephone,
        ':photo1' => $photos['photo1'],
        ':photo2' => $photos['photo2'],
        ':photo3' => $photos['photo3'],
        ':photo4' => $photos['photo4'],
        ':photo5' => $photos['photo5']
    );

    $result = $statement->execute($params);

    if ($result) {
        echo '<p class="pagpubvalidation">Votre maison a été publiée avec succès.</p>';
    } else {
        echo '<p class="pagpuberreur">Une erreur est survenue lors de la publication de la maison.</p>';
    }*/
}
?>
<br><br><br><br><br>

    <h1 class="pagpubh1">Publication d'une maison</h1>
    <aside container-fluid>
        <div class="info">
        <h2 class="p-3"><i class="bi bi-info-circle-fill"></i> Pour une meilleure visibilité, <strong> Reduisez</strong> la taille ou <strong>Compressez </strong>les images avant de les télécharger</h2>
        <p class="p-3"> Assurez-vous que chaque image ne dépasse pas 1 Mo soit 1024 Ko voire 1048576 Octets. Limitez la largeur des images à 1280px et la hauteur à 720px.</p>
        <p class="p-3">Soit <a href="https://tinyjpg.com/"> Compressez vos images ICI</a> soit <a href="https://www.online-image-editor.com/?language=french"> Redimensionner vos images ICI</a> soit utilisez <a href="https://convert-my-image.com/Fr" target="_blank" rel="noopener noreferrer"> cet outil simple</a>.</p>
        </div>
    </aside>
<br><br><br>
    <form method="post" action="" enctype="multipart/form-data" class="pagpubform">
        <label for="titre" class="pagpublabel"><strong>Titre de l'annonce<sup style="color: red; font-size: 20px;">*</sup></strong> <i class="fa fa-info-circle tooltip-large" data-toggle="tooltip" title="Caractères autorisés : les chiffres." data-placement="right"></i></label><br>
        <input type="text" id="titre" name="titre" required class="pagpubtext" minlength="2" maxlength="100"><br><br>

        <label for="description" class="pagpublabel"><strong>Description de l'annonce<sup style="color: red; font-size: 20px;">*</sup></strong></label><br>
        <textarea id="description" class="pagpubtextarea" name="description" required></textarea><br><br>

        <label for="prix" class="pagpublabel"><strong>Prix<sup style="color: red; font-size: 20px;">*</sup></strong></label><br>
        <input type="number" id="prix" name="prix" required class="pagpubnumber" placeholder="Mettez le prix negociable" ><br><br>

        <label for="region" class="pagpublabel"><strong>Région<sup style="color: red; font-size: 20px;">*</sup></strong></label><br>
        <!-- Ici, vous pouvez insérer la balise <select> pour les régions -->
        <select id="region" class="pagpubselect container" name="region" onchange="afficherVilles()" required>
            <option value="">Sélectionner une région</option>
            <option value="District autonome d'Abidjan">District autonome d'Abidjan</option>
            <option value="District autonome de Yamoussoukro">District autonome de Yamoussoukro</option> 
            <option value="Indénié-Djuablin">Indénié-Djuablin</option>
            <option value="Sud-Comoé">Sud-Comoé</option>
            <option value="Folon">Folon</option>
            <option value="Kabadougou">Kabadougou</option>
            <option value="Goh">Goh</option>
            <option value="Loh-Djiboua">Loh-Djiboua</option>
            <option value="Iffou">Iffou</option>
            <option value="Moronou">Moronou</option>
            <option value="N'zi">N'zi</option>
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
            <label for="ville" class="pagpublabel"><strong>Ville<sup style="color: red; font-size: 20px;">*</sup></strong> :</label><br>
            <select id="ville" class="pagpubselect" name="ville" required>
                <option value="">Sélectionner une ville</option>
                <!-- Les options de villes seront ajoutées dynamiquement via JavaScript -->
            </select>
        </div><br>

        <label for="telephone" class="pagpublabel"><strong>Téléphone<sup style="color: red; font-size: 20px;">*</sup></strong></label><br>
        <input type="tel" id="telephone" class="pagpubtel" name="telephone" required minlength="10" maxlength="15"><br><br>

        <label for="photo" class="pagpublabel"><strong>Télécharger les photos (PNG ou JPG ou JPEG)<sup style="color: red; font-size: 20px;">*</sup></strong></label><br>
        <input type="file" id="photo" class="pagpubfile" name="photo[]" multiple accept=".png, .jpg, .jpeg" required><br><br>
<p style="color: green "> Une annonce avec de belles images a plus de chance d'etre vue et a de la valeur qu'une annonce sans images </p>
        <input type="submit" value="Publier" class="pagpubsubmit">
    </form>

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
                case 'District autonome d\'Abidjan':
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
                case 'N\'zi':
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
                    villes = ['San-Pedro', 'Grand Berebi'];
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

        // Fonction pour ajouter une photo
        function ajouterPhoto() {
            var photoInput = document.createElement('input');
            photoInput.type = 'file';
            photoInput.name = 'photos[]';
            photoInput.accept = 'image/*';
            photoInput.required = true;

            var photosContainer = document.getElementById('photos-container');
            photosContainer.appendChild(photoInput);
        }
    </script>

<br><br><br>

<?php include('footerinclu.php'); ?>