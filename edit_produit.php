<?php
session_start();
require_once 'Database.php';

$db = Database::getInstance();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect if product ID is not provided
    header('Location: gerer_produit.php');
    exit();
}

$productId = $_GET['id'];

// Fetch product details from the database
$sql = "SELECT * FROM produit WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    // Redirect if product ID is invalid or not found
    header('Location: gerer_produit.php');
    exit();
}

// Process form submission if POST request is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = floatval($_POST['prix']);
    $quantity = intval($_POST['quantity']);

   // Update product details in the database
$sql = "UPDATE produit SET nom = ?, description = ?, prix = ?, quantite = ? WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$nom, $description, $prix, $quantity, $productId]);


    // Set a session message to indicate successful update
    $_SESSION['message'] = 'Produit mis à jour avec succès';

    // Redirect back to the product management page
    header('Location: gerer_produit.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Modifier Produit</h2>
    <form action="edit_produit.php?id=<?= $productId; ?>" method="post">
        <div class="form-group">
            <label for="nom">Nom du produit:</label>
            <input type="text" id="nom" name="nom" class="form-control" value="<?= htmlspecialchars($product['nom']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($product['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" class="form-control" value="<?= $product['prix']; ?>" required>
        </div>
        <div class="form-group">
    <label for="quantity">Quantité :</label>
    <input type="number" id="quantity" name="quantity" class="form-control" value="<?= isset($product['quantity']) ? $product['quantity'] : ''; ?>" required>
</div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
</body>
</html>
