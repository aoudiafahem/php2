<?php
session_start();
require_once 'Database.php';

$db = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $productId = $_POST['id'];
    $sql = "DELETE FROM produit WHERE id = ?";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute([$productId]);
        $_SESSION['message'] = 'Produit supprimé avec succès';
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de la suppression du produit: " . $e->getMessage();
    }
    
    // Redirect back to the manage products page or wherever appropriate
    header('Location: gerer_produit.php');
    exit();
} else {
    // Redirect if accessed without posting data
    header('Location: gerer_produit.php');
    exit();
}
?>
