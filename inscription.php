<?php
session_start();

require_once 'User.php';

class InscriptionController {
    private $user;
    
    public function __construct(User $user) {
        $this->user = $user;
    }
    
    public function registerUser($username, $email, $password) {
        if ($this->user->register($username, $email, $password)) {
            header('Location: connection.php');
            exit;
        } else {
            return 'Email déjà utilisé ou erreur lors de l\'inscription. Veuillez réessayer.';
        }
    }
}

$user = new User();
$inscriptionController = new InscriptionController($user);
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $message = $inscriptionController->registerUser($username, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Inscription</h2>
    <?php if (!empty($message)): ?>
        <p class="alert alert-warning"><?= $message; ?></p>
    <?php endif; ?>
    <form action="inscription.php" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button> Vous avez un compte ? <a href="connection.php">Connectez-vous</a>
    </form>
</div>
</body>
</html>
