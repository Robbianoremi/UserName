  <?php
  session_start(); // Démarrage de la session
  require 'function.php';
  logedIn();
  $user = $_SESSION['profil'];
  
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <h1>Coucou <?= $user['name'] ?> et <?php echo $user['name'] ?></h1>
    <pre>id user : <?= $user['id']?></pre>
    <p> <?= $user['email'] ?></p>
    <p> password crypté : <?= $user['password'] ?></p>
    <a href="logout.php">déconnexion</a>
 </body>
 </html>