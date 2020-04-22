<?php 
    require 'Parts/connexion.php';
    session_start();
    if($_SESSION['user']['admin'] == 1){  
        //connexion a la bdd
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=la_saint_redstone;charset=utf8', 'root', '');

            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(Exception $e){

            die('Il y a un problème avec la bdd : ' . $e->getMessage());
        }


        $response = $bdd->prepare("DELETE FROM `article` WHERE `id` = ? ");    

        $response->execute([
            $_GET['id']
        ]);

        $response->closeCursor();
    };
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La sainte redstone - Articles</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php 
        include 'Parts/nav.php'; 
    ?>
    <div class="container">
        <div class="row">
            <h1 class="text-center col-12 mt-5">Supression d'un article</h1>
        </div>

        <p class="alert alert-success col-12 mt-4">L'article a bien été supprimé ! <a href="articles.php">Cliquez ici</a> pour revenir à la liste des articles.</p>        
    </div>


    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>