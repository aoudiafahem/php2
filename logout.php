<?php
// Démarrez la session
session_start();

// Déconnectez l'utilisateur en détruisant toutes les données de session
session_destroy();

// Redirigez l'utilisateur vers la page d'accueil ou toute autre page de votre choix
header("Location: connection.php");
exit();
?>
