<?php 
    require 'Parts/connexion.php'; // on recup les identifiant de connexion
    session_start();
    if(!isConnected()){
        if(
            isset($_POST['email']) &&
            isset($_POST['password']) // verif de l'existance des champ
        ){         
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors[] = 'Email invalide !';
            } // email
            if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#$%&\'()*+,\-\.\/:;<=>?\\\\@[\]\^_`{|}~]).{8,1000}$/', $_POST['password'])){
                $errors[] = 'Mot de passe doit contenir minimum 1 maj, 1 min, 1 chiffre et un caractère spécial !';
            } // mdp

            if(!isset($errors)){
                //connexion a la bdd
                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=la_saint_redstone;charset=utf8', 'root', '');

                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                } catch(Exception $e){

                    die('Il y a un problème avec la bdd : ' . $e->getMessage());
                }               
        
                // verification que l'email et le mdp soit exacte
                $stmt = $bdd->prepare("SELECT * FROM `users` WHERE `email` = ?");
                $stmt->execute([
                    $_POST['email']
                ]);
                $user = $stmt->fetch();        
                if (!empty($user)) {
                    
                    if(password_verify($_POST['password'], $user['password'])){
                        // message de succès + connection de l'utilisateur*
                        $successMessage = " connexion établie ";

                        $_SESSION['user'] = $user;

                    } else {
                        $errors[] = 'Mot de passe incorrect';
                    }

                }else {
                    $errors[] = 'Compte inexistant'; // pas bon 
                }

            };
        };
    };


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La sainte redstone - Connexion </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php 
        include 'Parts/nav.php';  
    ?>
    <?php
        if(isset($errors)){ // afffichage erreur
            foreach($errors as $error){
                echo '<p style="color:red;">' . $error . '</p>';
            }
        }
        if(isset($successMessage)){ // affichage succes
            echo '<p class="alert alert-success col-12" style="color:green;">' . $successMessage .'<a href="index.php">Cliquez ici</a> pour revenir à l\'accueil </p>';
        } else {         
        if(!isConnected()){
    ?>

        <div class="container">
            <div class="row">
                <h1 class="text-center col-12 mt-5">Connexion</h1>
            </div>
            <div class="row">
                <form action="login.php" method="POST" class="col-12 col-md-6 offset-md-3 my-5">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" value="" class="form-control" name="email"  placeholder="alice@exemple.com">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" >
                    </div>
                    <input type="submit" value="Connexion" class="btn btn-success col-12 my-2 bg-info">
                </form>
            </div>
        </div>
    <?php

        } else {
            echo '<p style="color:red;">Vous êtes déjà connecté !</p>';
        }
    }

    ?>
    
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>