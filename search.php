<?php 
    require 'Parts/connexion.php';
    session_start();
    
    //connexion a la bdd
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=la_saint_redstone;charset=utf8', 'root', '');

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(Exception $e){

        die('Il y a un problème avec la bdd : ' . $e->getMessage());
    }

    $response = $bdd->prepare("SELECT * FROM article WHERE title LIKE '%?%' OR content LIKE '%?%'");

    $response->execute([
        $_GET['query'],
        $_GET['query']
    ]);

    $article = $response->fetchAll(PDO::FETCH_ASSOC);
    $response->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La sainte redstone - Recherche</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php 
        include 'Parts/nav.php'; 

        echo '<pre>';
        print_r($article);
        print_r($_GET);
        echo '</pre>';
    ?>
    
    <div class="container">
        <div class="row">
            <h1 class="text-center col-12 mt-5">Résultats pour la recherche :  <?php echo htmlspecialchars($_GET['query']) ?> </h1>
        </div>
        <div class="row">
            <h2 class="text-center col-12 my-3"><?php

                if(count($article) <1 ){
                    echo 'Il n\'y a pas de résultat pour votre recherche';

                }elseif(count($article) >=1 ){
                    echo count($article);
                }
                ?> résultat(s)
            </h2>


            <table class="table table-hover col-12 mt-4">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Date de parution</th>
                    </tr>
                </thead>    
                <tbody>          
                    <tr>
                        <td class="col-6"><a href="article.php?id=8"><?php echo htmlspecialchars($article[0]['title']) ?></a></td>
                        <td class="col-2"><?php echo htmlspecialchars($article[0]['firstname']) ?></td>
                        <td class="col-3"><?php echo htmlspecialchars($article[0]['create_date']) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>












    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>