<?php
session_start();
require_once 'Database.php';

$db = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = floatval($_POST['prix']);
    $quantity = intval($_POST['quantity']);

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $name = basename($_FILES['image']['name']);  // Sanitize the filename
        $upload_directory = 'path/to/your/upload/directory/';
        $final_path = $upload_directory . $name;

        if (!file_exists($upload_directory)) {
            mkdir($upload_directory, 0777, true);
        }

        if (move_uploaded_file($tmp_name, $final_path)) {
            $sql = "INSERT INTO produit (nom, description, prix, quantite, image_url) VALUES (?, ?, ?, ?, ?)";
            try {
                $stmt = $db->prepare($sql);
                $stmt->execute([$nom, $description, $prix, $quantity, $final_path]);
                echo 'Le produit a été ajouté avec succès!';
            } catch (PDOException $e) {
                echo 'Erreur de base de données: ' . $e->getMessage();
            }
        } else {
            echo 'Une erreur s\'est produite lors du téléchargement du fichier.';
        }
    } else {
        echo 'Erreur lors du téléchargement du fichier: ' . $_FILES['image']['error'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout de Produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-4">Ajouter un Produit</h2>
           
            <a href="acceuil.php" class="btn btn-outline-secondary mt-3">Retour</a>
        </div>
        <form action="ajouter_produit.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du produit:</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix:</label>
                <input type="number" id="prix" name="prix" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantité :</label>
                <input type="number" id="quantity" name="quantity" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>

