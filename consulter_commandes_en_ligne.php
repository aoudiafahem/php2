<?php
session_start();
require_once 'Database.php';

$db = Database::getInstance();
$produits = $db->query("SELECT * FROM produit")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
    <a href="acceuil.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4 mb-4">Liste des Produits</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>image</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= $produit['nom']; ?></td>
                    <td><?= $produit['description']; ?></td>
                    <td><img src="<?= htmlspecialchars($produit['image_url']); ?>" alt="Image de <?= htmlspecialchars($produit['nom']); ?>" style="max-width: 100px;"></td>
                    <td><?= $produit['prix']; ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
