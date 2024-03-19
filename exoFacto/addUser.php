<?php
session_start();
require_once 'db.php';
if (isset($_POST['submit'])) {
    $username = trim(htmlspecialchars($_POST['name'])); // Nettoyage du nom d'utilisateur
    // Utilisez trim() pour supprimer les espaces avant et après le nom d'utilisateur
    // Utilisez htmlspecialchars() pour convertir les caractères spéciaux en entités HTML
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validation de l'adresse e-mail
    $hashPass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Vérification de l'existence du nom dans la base de données
    $sql = "SELECT COUNT(*) FROM username WHERE `name` = :name"; // Requête SQL pour compter le nombre de noms identiques
    $stmt = $pdo->prepare($sql); // Préparation de la requête
    $stmt->bindParam(':name', $username); // Liaison de la variable $username à la requête
    $stmt->execute(); // Exécution de la requête
    $nameCount = $stmt->fetchColumn(); // Récupération du résultat

    if ($nameCount == 0) {
        // Le nom n'existe pas, donc on peut l'insérer
        $sql = "INSERT INTO username (`name`,`email`,`password`) VALUES (:name, :email, :password)"; // Requête SQL pour insérer un nouveau nom
        $stmt = $pdo->prepare($sql); // Préparation de la requête
        $stmt->bindParam(':name', $username); // Liaison de la variable $username à la requête
        $stmt->bindParam(':email', $email); // Liaison de la variable $email à la requête
        $stmt->bindParam(':password', $hashPass); // Liaison de la variable $hashPass à la requête
        $stmt->execute(); // Exécution de la requête
        $lastId = $pdo->lastInsertId(); // Récupération de l'ID du dernier enregistrement
        $_SESSION['profil'] = ['name' => $username, 'email' => $email, 'password' => $hashPass, 'id' => $lastId]; // Création de la session utilisateur
        header('Location: profil.php'); // Redirection vers la page de profil
        exit; // Arrêt du script

    } else {
        $_SESSION['message'] = "Le nom d'utilisateur existe déjà !"; // Message d'erreur
        header('Location: index.php'); // Redirection vers la page d'accueil
        exit; // Arrêt du script
    }
    
} else {
    $_SESSION['message'] = "Veuillez saisir un nom d'utilisateur."; // Message d'erreur
    header('Location: index.php'); // Redirection vers la page d'accueil
    exit; // Arrêt du script
}
