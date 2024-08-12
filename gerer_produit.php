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
    <title>Gérer les Produits</title>
    <a href="acceuil.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
</head>
<body>
<div class="container">
    <h2 class="mt-4 mb-4">Gérer les Produits</h2>
    <?php if (empty($produits)): ?>
        <div class="alert alert-info" role="alert">
            Aucun produit trouvé.
        </div>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit): ?>
                    <tr>
                        <td><?= htmlspecialchars($produit['nom']); ?></td>
                        <td><?= htmlspecialchars($produit['description']); ?></td>
                        <td><?= number_format($produit['prix'], 2); ?> €</td>
                        <td><?= htmlspecialchars($produit['quantite']); ?></td>
                        <td><img src="<?= htmlspecialchars($produit['image_url']); ?>" alt="Image de <?= htmlspecialchars($produit['nom']); ?>" style="max-width: 100px;"></td>
                        <td>
                            <a href="edit_produit.php?id=<?= $produit['id']; ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i> Modifier</a>
                            <form action="delete_produit.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                <input type="hidden" name="id" value="<?= $produit['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
                </div>

<!-- Ajouter Font Awesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
