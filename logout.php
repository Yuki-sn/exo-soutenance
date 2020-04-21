<?php

// Inclusion de la fonction isConnected()
require 'Parts/connexion.php';

// Nécessaire pour pouvoir utiliser les variables de session
session_start();

// Si le l'utilisateur est bien connecté, on détruit le tableau user dans la session, ce qui deconnecte l'utilisateur
if(isConnected()){
    unset($_SESSION['user']);
    $success = true;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La sainte redstone - Deconnexion</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
    include 'Parts/nav.php';
    ?>
    <h1 class="text-center col-12 mt-5">Déconnexion</h1>

    <?php
    
    // Si l'utilisateur est connecté, on affiche un message confirmant la déconnexion, sinon message d'erreur
    if(isset($success)){
        echo '
        <p class="alert alert-success col-12"
            style="color:green;">
            Vous avez bien été déconnecté 
                <a href="index.php">Cliquez ici pour revenir à l\'accueil </a>!
        </p>';
    };
    
    ?>

</body>
</html>