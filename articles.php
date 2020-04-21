<?php 
    require 'Parts/connexion.php';
    session_start();

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
            <h1 class="text-center col-12 mt-5">Liste des articles</h1>
        </div>
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
                    <td class="col-6">                                                                               
                        <a href="article.php?id=2">Les voitures sans roues s...</a>
                    </td>
                    <td class="col-2">Alice</td>

                    <td class="col-3">lundi 20 avril 2020 à 19:17:33</td>
                    </tr>
                    <tr>
                    <td class="col-6">
                        <a href="article.php?id=1">Sortie de la nouvelle Peu...</a>
                    </td>
                    <td class="col-2">Alice</td>
                    </td>      
                    <td class="col-3">lundi 20 avril 2020 à 19:16:00</td>
                </tr>
            </tbody>
        </table>
    </div>



    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>