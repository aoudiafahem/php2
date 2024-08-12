<?php
session_start();
require_once 'Database.php';

// Vérifie si le panier existe dans la session, sinon initialise-le
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Vérifie si une action a été spécifiée dans l'URL
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $produitId = $_GET['id'];

    // Vérifie l'action spécifiée et met à jour la quantité du produit dans le panier
    switch ($action) {
        case 'add':
            if (isset($_SESSION['panier'][$produitId])) {
                $_SESSION['panier'][$produitId]++;
            } else {
                $_SESSION['panier'][$produitId] = 1;
            }
            break;
        case 'remove':
            if (isset($_SESSION['panier'][$produitId])) {
                if ($_SESSION['panier'][$produitId] > 1) {
                    $_SESSION['panier'][$produitId]--;
                } else {
                    unset($_SESSION['panier'][$produitId]);
                }
            }
            break;
        case 'delete': // Ajout d'un cas pour supprimer complètement le produit du panier
            if (isset($_SESSION['panier'][$produitId])) {
                unset($_SESSION['panier'][$produitId]);
            }
            break;
        // Ajoutez d'autres actions si nécessaire
    }
}

$db = Database::getInstance();
$produitsDansPanier = $_SESSION['panier'] ?? [];
$produits = [];
$total = 0; // Variable pour stocker le total du panier

if ($produitsDansPanier) {
    $placeholders = implode(',', array_fill(0, count($produitsDansPanier), '?'));
    $stmt = $db->prepare("SELECT * FROM produit WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($produitsDansPanier));
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calcul du total en parcourant chaque produit dans le panier
    foreach ($produits as $produit) {
        $total += $produit['prix'] * $produitsDansPanier[$produit['id']];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Votre Panier</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['nom']); ?></td>
                    <td><?= htmlspecialchars($produit['description']); ?></td>
                    <td><?= number_format($produit['prix'], 2); ?> €</td>
                    <td><?= htmlspecialchars($produitsDansPanier[$produit['id']]); ?></td>
                    <td><img src="<?= htmlspecialchars($produit['image_url']); ?>" alt="Image de <?= htmlspecialchars($produit['nom']); ?>" style="max-width: 100px;"></td>
                    <td>
                        <a href="voir_panier.php?action=remove&id=<?= $produit['id']; ?>" class="btn btn-danger btn-sm">-</a>
                        <a href="voir_panier.php?action=add&id=<?= $produit['id']; ?>" class="btn btn-success btn-sm">+</a>
                        <a href="voir_panier.php?action=delete&id=<?= $produit['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="mt-3">
        <h4>Total du Panier: <?= number_format($total, 2); ?> €</h4>
    </div>
    <a href="vendor/index.php" class="btn btn-primary">Passer la commande</a>
    <a href="produit.php" class="btn btn-secondary">Retour </a>
</div>
</body>
</html>
