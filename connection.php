<?php
session_start();

require_once 'User.php';
class ConnectionController {
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function loginUser($email, $password) {

        if ($email === 'aoudia@gmail.com' && $password === '123') {

            header('Location: acceuil.php');
            exit;
        }

        // Sinon, vérifier les informations de connexion normales
        if ($this->user->login($email, $password)) {
            header('Location: produit.php');
            exit;
        } else {
            return 'Email ou mot de passe incorrect. Veuillez réessayer.';
        }
    }
}


$user = new User();
$connectionController = new ConnectionController($user);
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $message = $connectionController->loginUser($email, $password);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Connexion</h2>
    <?php if (!empty($message)): ?>
        <p class="alert alert-warning"><?= $message; ?></p>
    <?php endif; ?>
    <form action="connection.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <div class="mt-3">
            Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous</a>
        </div>
    </form>
</div>
</body>
</html>
