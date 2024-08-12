<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Administrateur</title>
    <!-- Utilisation de la dernière version de Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-3">Bienvenue, Administrateur "Fahim" </h2>
        <p>Vous êtes connecté en tant qu'administrateur.</p>
        <p>Que souhaitez-vous faire aujourd'hui ?</p>
        <div class="list-group mb-4">
            <a href="ajouter_produit.php" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-plus-circle me-2"></i> Ajouter un Produit
            </a>
            <a href="gerer_produit.php" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-edit me-2"></i> Gérer Produits
            </a>
            <a href="gerer_utilisateur.php" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-users-cog me-2"></i> Gérer Utilisateurs
            </a>
            <a href="consulter_commandes_en_ligne" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-shopping-cart me-2"></i> Gérer Commandes
            </a>
        </div>
        <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
    </div>
</body>
</html>
