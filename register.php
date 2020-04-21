<?php
    // inclution du fichier si captcha ok
    require 'recaptchaValid.php';

    // appel des variable du form
    if(
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['confirm-password']) &&
        isset($_POST['firstname']) &&
        isset($_POST['lastname']) &&
        isset($_POST['g-recaptcha-response'])
    ){
    
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Email invalide !';
        } // email

    

        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#$%&\'()*+,\-\.\/:;<=>?\\\\@[\]\^_`{|}~]).{8,1000}$/', $_POST['password'])){
            $errors[] = 'Mot de passe doit contenir minimum 1 maj, 1 min, 1 chiffre et un caractère spécial !';
        } // mdp
    
        if($_POST['confirm-password'] != $_POST['password']){
            $errors[] = 'Confirmation mot de passe différente !';
        } // mdp


        if(!preg_match('/^[a-z áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\']{2,25}$/i', $_POST['firstname'])){
            $errors[] = 'Prénom invalide';
        } // prénom


        if(!preg_match('/^[a-z áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\']{2,25}$/i', $_POST['lastname'])){
            $errors[] = 'Nom invalide';
        } // nom

        if(!recaptcha_valid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'])){
            $errors[] = 'Captcha invalide !';
        } // captcha google


        if(!isset($errors)){
            //connexion a la bdd
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=la_saint_redstone;charset=utf8', 'root', '');
    
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            } catch(Exception $e){
    
                die('Il y a un problème avec la bdd : ' . $e->getMessage());
            }

                $stmt = $bdd->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([
                $_POST['email']
                ]); 
            $user = $stmt->fetch();

            if ($user) {
                $errors[] = 'Email déja utilisé !';
            } // email déja utilisé ou pas 
        }
   

        if(!isset($errors)){
    
            // Insertion d'un nouveau compte en bdd avec une requête préparée
            $response = $bdd->prepare("INSERT INTO `users`( `email`, `password`, `firstname`, `lastname`, `admin`, `register_date`, `activated`, `register_token`) VALUES(?,?,?,?,?,?,?,?)");
    
    
            $response->execute([
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_BCRYPT), 
                $_POST['firstname'],
                $_POST['lastname'],
                0,
                date('Y-m-d H:i:s'),
                0,
                0
            ]);
    

            if($response->rowCount() > 0){
                $successMessage = 'Votre compte a bien été créé !';
            } else {
                $errors[] = 'Problème avec la bdd';
            }
    
            // Fermeture de la requête
            $response->closeCursor();
    
        }

    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La sainte redstone - Inscription</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
    <?php 
        include 'Parts/nav.php'; 
        
        if(isset($errors)){
            foreach($errors as $error){
                echo '<p style="color:red;">' . $error . '</p>';
            }
        }

        if(isset($successMessage)){
            echo '<p style="color:green;">' . $successMessage . '</p>';
        } else {
    ?>

        <div class="container">
            <div class="row">
                <h1 class="text-center col-12 mt-5">Inscription</h1>
            </div>
            <div class="row">
                <form action="register.php" method="POST" class="col-12 col-md-6 offset-md-3 my-5">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" value="" class="form-control" name="email" placeholder="Exemple.e@exemple.com">
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" >
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirmation mot de passe</label>
                        <input type="password" class="form-control" name="confirm-password" >
                    </div>

                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" value="" class="form-control" name="firstname" placeholder="Pierre">
                    </div>

                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="text" value="" class="form-control" name="lastname"  placeholder="Smith">
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LdVwusUAAAAABVIlGGzgITYtHAzuGkN6o7vLyGI"></div>
                    </div>

                    <input type="submit" value="M'inscrire" class="btn btn-success col-12 my-2">
                </form>     
            </div>
        </div>
    <?php
    }
    ?>

    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>