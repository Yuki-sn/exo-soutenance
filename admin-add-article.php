<?php 
    require 'Parts/connexion.php';
    session_start();

    if($_SESSION['user']['admin'] == 1){  
        
        if(
            isset($_POST['title']) && 
            isset($_POST['content']) 
        ){

            if(mb_strlen($_POST['title']) < 2 || mb_strlen($_POST['title']) > 150 ){
                $errors[] = ' Le titre doit avoir entre 2 et 150 caractères ';
            };

            if(mb_strlen($_POST['content']) < 2 || mb_strlen($_POST['content']) > 20000 ){
                $errors[] = ' Le titre doit avoir entre 2 et 20000 caractères =)';
            };

            if(!isset($errors)){
                //connexion a la bdd
                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=la_saint_redstone;charset=utf8', 'root', '');
        
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                } catch(Exception $e){
        
                    die('Il y a un problème avec la bdd : ' . $e->getMessage());
                }    

                $response = $bdd->prepare("INSERT INTO `article`(`title`, `author`, `create_date`, `content`) VALUES (?,?,?,?)");

                $response->execute([
                    $_POST['title'],
                    $_SESSION['user']['id'],
                    date('Y-m-d H:i:s'),
                    $_POST['content']
                ]);
            
            }

            if($response->rowCount() > 0){

                $successMessage = 'Votre artciles a bien étais ajouter ';
            }else {
                $errors[] = 'Problème avec l\'ajout à la bdd';
            }

            $response->closeCursor();
        }
    };
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La sainte redstone - Admin page </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php 
        include 'Parts/nav.php';  
        if(isset($errors)){ // message erreur
            foreach($errors as $error){
                echo '<p style="color:red;">' . $error . '</p>';
            }
        }

        if(isset($successMessage)){ // message succes
            echo '<p style="color:green;">' . $successMessage . '</p>';
        } else {
    ?>
        <div class="container">
                <div class="row">
                    <h1 class="text-center col-12 mt-5">Administration : Ajout d'un nouvel Article</h1>
                </div>
                <div class="row">
                    <form action="admin-add-article.php" method="POST" class="col-12 col-md-6 offset-md-3 my-5">
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" value="" class="form-control" name="title" id="title" placeholder="un titre : les tacos ces la vie">
                        </div>
                        <div class="form-group">
                            <label for="content">Contenu</label>
                            <textarea class="form-control" rows="10" name="content" id="content"></textarea>
                        </div>
                            <input type="hidden" name="csrf-token" value="5616dad0a53e3b95fc3857920c87ef43">
                            <input type="submit" value="Créer" class="btn bg-info col-12 my-2">
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