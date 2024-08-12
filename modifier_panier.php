<?php
session_start();

class Panier {
    public function __construct() {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }

    public function ajouterProduit($produitId) {
        if (!isset($_SESSION['panier'][$produitId])) {
            $_SESSION['panier'][$produitId] = 0;
        }
        $_SESSION['panier'][$produitId]++;
    }

    public function retirerProduit($produitId) {
        if (isset($_SESSION['panier'][$produitId])) {
            if ($_SESSION['panier'][$produitId] > 1) {
                $_SESSION['panier'][$produitId]--;
            } else {
                unset($_SESSION['panier'][$produitId]);
            }
        }
    }

    public function traiterAction($action, $produitId) {
        switch ($action) {
            case 'add':
                $this->ajouterProduit($produitId);
                break;
            case 'remove':
                $this->retirerProduit($produitId);
                break;
        }
    }

    public function redirigerVersPanier() {
        header('Location: panier.php');
        exit;
    }
}

// Utilisation de la classe Panier
$panier = new Panier();
$action = $_GET['action'] ?? null;
$idProduit = $_GET['id'] ?? null;

if ($action && $idProduit) {
    $panier->traiterAction($action, $idProduit);
}

$panier->redirigerVersPanier();
?>
