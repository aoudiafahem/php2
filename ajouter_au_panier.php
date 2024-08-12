<?php
session_start();

class Panier {
    public function __construct() {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }

    public function ajouterProduit($idProduit) {
        if ($idProduit) {
            // Ajouter ou mettre à jour la quantité du produit dans le panier
            $_SESSION['panier'][$idProduit] = ($_SESSION['panier'][$idProduit] ?? 0) + 1;
        }
    }

    public function redirigerVersPanier() {
        header('Location: panier.php');
        exit;
    }
}

// Utilisation de la classe Panier
$panier = new Panier();
$idProduit = $_GET['id'] ?? null;
$panier->ajouterProduit($idProduit);
$panier->redirigerVersPanier();
?>
