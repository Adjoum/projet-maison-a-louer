<?php session_start(); // Démarrer la sessio

// Détruire toutes les variables de session
session_destroy();

// Rediriger vers la page de connexion
header("Location: connexionfin.php");
exit();
?>