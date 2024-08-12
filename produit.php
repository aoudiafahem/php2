<?php
// panier.php
require_once 'Database.php'; 
session_start(); 

$db = Database::getInstance();
$produits = $db->query("SELECT * FROM produit")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .card {
            max-width: 300px;
        }
        .card-img-top {
            max-height: 150px;
            object-fit: contain;
        }
        .card-text {
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="#">Fahim Store</a>
    <a href="voir_panier.php" class="btn btn-outline-success my-2 my-sm-0">
        <i class="bi bi-cart-fill"></i> Panier 
        <span class="badge badge-light"><?= array_sum($_SESSION['panier'] ?? []) ?></span>
    </a>
</div>
<div class="container">
    <h2>Produits</h2>
    <div class="row">
        <?php foreach ($produits as $produit): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="<?= $produit['image_url']; ?>" class="card-img-top" alt="<?= htmlspecialchars($produit['nom']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($produit['nom']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($produit['description']); ?></p>
                        <p class="card-text">Prix: <?= htmlspecialchars($produit['prix']); ?>€</p>
                        <p class="card-text">Quantité disponible: <?= htmlspecialchars($produit['quantite']); ?></p>
                        <!-- Bouton "Ajouter au panier" avec le nombre d'ajoutements -->
                        <a href="ajouter_au_panier.php?id=<?= $produit['id']; ?>" class="btn btn-primary">Ajouter au panier (<?= $_SESSION['ajoutements'][$produit['id']] ?? 0 ?>)</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
