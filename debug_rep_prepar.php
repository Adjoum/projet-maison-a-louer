function executeRequete($req, $params = [])
{
    // Connexion à la base de données (à adapter avec vos informations de connexion)
    $servername = "localhost";
    $username = "votre_nom_utilisateur";
    $password = "votre_mot_de_passe";
    $dbname = "votre_base_de_données";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Définir l'attribut pour les erreurs PDO en mode exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL
        $stmt = $conn->prepare($req);

        // Exécuter la requête avec les paramètres s'il y en a
        $stmt->execute($params);

        // Retourner le résultat de la requête
        return $stmt;

    } catch(PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur
        die("Erreur sur la requête SQL.<br>Message : " . $e->getMessage() . "<br>Code: " . $req);
    }
}

function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px; float: right; clear: both; ">';
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    echo 'Debug demandé dans le fichier : ' . $trace['file'] . ' à la ligne ' . $trace['line'] . '.';
    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}