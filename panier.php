<?php
require_once 'Database.php'; 
session_start(); // Assurez-vous de démarrer la session au début du script

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
        /* Ajoutez du CSS personnalisé pour redimensionner les cartes et les éléments internes */
        .card {
            max-width: 300px; /* Limitez la largeur de la carte */
        }
        .card-img-top {
            max-height: 150px; /* Définissez la hauteur maximale de l'image */
            object-fit: contain; /* Assurez-vous que l'image est entièrement visible sans déformation */
        }
        .card-text {
            font-size: 14px; /* Réduisez la taille du texte de la description */
        }
    </style>
</head>
<body>

<div class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="#">Store Fahim</a>
    <div>
        <a href="connection.php" class="btn btn-outline-primary my-2 my-sm-0">Déconnexion</a>
        <a href="voir_panier.php" class="btn btn-outline-success my-2 my-sm-0">
            <i class="bi bi-cart-fill"></i> Panier 
            <span class="badge badge-light"><?= array_sum($_SESSION['panier'] ?? []) ?></span>
        </a>
    </div>
</div>


<div class="container">
    <h2>Nos Produits</h2>
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
                        <a href="ajouter_au_panier.php?id=<?= $produit['id']; ?>" class="btn btn-primary">Ajouter au panier</a>
                        <a href="modifier_panier.php?action=remove&id=<?= $produit['id']; ?>" class="btn btn-sm btn-danger">-</a>
                        <a href="modifier_panier.php?action=add&id=<?= $produit['id']; ?>" class="btn btn-sm btn-success">+</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
