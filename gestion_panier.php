<?php
session_start();

class Panier {
    public function __construct() {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }

    public function ajouterProduit($produitId) {
        // Logique pour ajouter un produit au panier
    }

    public function supprimerProduit($produitId) {
        if (isset($_SESSION['panier'][$produitId])) {
            unset($_SESSION['panier'][$produitId]); // Supprime le produit du panier
        }
    }

    public function traiterAction($action, $produitId) {
        switch ($action) {
            case 'add':
                $this->ajouterProduit($produitId);
                break;
            case 'remove':
                $this->supprimerProduit($produitId);
                break;
            // Ajoutez d'autres actions si nécessaire
        }
    }

    public function rediriger() {
        $urlDeRetour = $_SERVER['HTTP_REFERER'] ?? 'panier.php'; // Fournit une URL par défaut si HTTP_REFERER n'est pas défini
        header('Location: ' . $urlDeRetour);
        exit;
    }
    
}

// Utilisation de la classe Panier
$panier = new Panier();
if (isset($_GET['action']) && isset($_GET['id'])) {
    $panier->traiterAction($_GET['action'], $_GET['id']);
}
$panier->rediriger();
?>
