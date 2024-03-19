
<?php
session_start(); // Démarrage de la session
if (isset($_GET['logout']) && $_GET['logout'] == 'success') { // Vérification de la déconnexion
    $message = "Vous avez été déconnecté avec succès."; // Message de déconnexion
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserMan</title>
</head>
<body>
<?php if (isset($message)) { echo "<h1>$message</h1>"; } ?> <!-- Affichage du message de déconnexion -->
    <form method="POST" action="addUser.php">
        <label for="name">Username</label>
        <input type="text" name="name" id="name">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="submit">
    </form>
</body>
</html>
<?php
if(isset($_SESSION['message'])){ // Vérification de l'existence du message de la session
    echo "<h1>" . $_SESSION['message'] . "</h1>"; // Affichage du message de la session
    unset($_SESSION['message']); // Suppression du message de la session
}
require 'db.php'; // Inclusion du fichier de connexion à la base de données

// Sélection et affichage des noms d'utilisateur
$sql = "SELECT name,email FROM username"; // Requête SQL pour obtenir tous les noms d'utilisateur
$stmt = $pdo->prepare($sql); // Préparation de la requête
$stmt->execute(); // Exécution de la requête
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération de tous les résultats dans un tableau associatif

    // Début du marquage HTML pour la liste
echo '<ul>';
foreach ($users as $user) { // Parcours du tableau des résultats
        echo '<li>' . $user['name'] .'<br>'. $user['email'] . '</li>'; // Affichage de chaque nom d'utilisateur ainsi que son email
}
echo '</ul>';