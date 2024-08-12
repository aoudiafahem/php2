<?php
session_start();
require_once 'Database.php';

$db = Database::getInstance();
$utilisateurs = $db->query("SELECT * FROM utilisateur")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Utilisateurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4 mb-4">Gérer les Utilisateurs</h2>
    <?php if (empty($utilisateurs)): ?>
        <div class="alert alert-info" role="alert">
            Aucun utilisateur trouvé.
        </div>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= htmlspecialchars($utilisateur['username']); ?></td>
                        <td><?= htmlspecialchars($utilisateur['email']); ?></td>
                        <td><?= htmlspecialchars($utilisateur['is_admin']); ?></td>
                        <td>
                            <a href="edit_utilisateur.php?id=<?= $utilisateur['id']; ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i> Modifier</a>
                            <form action="delete_utilisateur.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                <input type="hidden" name="id" value="<?= $utilisateur['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <a href="acceuil.php" class="btn btn-secondary float-right mt-3"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
</div>

<!-- Ajouter Font Awesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
