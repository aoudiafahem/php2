<?php
session_start();
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $userId = $_POST['id'];

        // Supprimer l'utilisateur de la base de données
        $db = Database::getInstance();
        $sql = "DELETE FROM utilisateur WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$userId]);

        // Rediriger vers la page de gestion des utilisateurs
        header("Location: gerer_utilisateurs.php");
        exit();
    }
} else {
    // Rediriger vers la page d'accueil si la requête n'est pas de type POST
    header("Location: accueil.php");
    exit();
}
?>
