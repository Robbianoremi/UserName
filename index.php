<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserMan</title>
</head>
<body>
    <form method="POST" action="addUser.php">
        <label for="name">Username</label>
        <input type="text" name="name" id="name">
        <input type="submit">
    </form>
</body>
</html>
<?php
session_start(); // Démarre la session pour pouvoir utiliser $_SESSION

if (isset($_SESSION['message'])) { // Vérifie si un message est enregistré dans la session
    echo "<h1>" . $_SESSION['message'] . "</h1>"; // Affiche le message
    unset($_SESSION['message']); // Supprime le message après l'affichage pour qu'il ne s'affiche pas de nouveau inutilement
}
// Connexion à la base de données
require('db.php');

// Sélection et affichage des noms d'utilisateur
$sql = "SELECT name FROM username"; // Requête SQL pour obtenir tous les noms d'utilisateur
$stmt = $pdo->prepare($sql); // Préparation de la requête
$stmt->execute(); // Exécution de la requête
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération de tous les résultats dans un tableau associatif

    // Début du marquage HTML pour la liste
echo '<ul>';
foreach ($users as $user) {
        echo '<li>' . htmlspecialchars($user['name']) . '</li>';
}
echo '</ul>';

