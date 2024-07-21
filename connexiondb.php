<?php session_start(); //--------- SESSION
//--------- BDD
try {
    $condb = new PDO('mysql:host=185.98.131.91;dbname=reche2186338;charset=utf8', 'reche2186338', 'pvtildrsvu');
    $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $e->getMessage());
}


//--------- VARIABLES
$contenu = '';
//--------- AUTRES INCLUSIONS
require_once("fonctionsinclu.php");
?>